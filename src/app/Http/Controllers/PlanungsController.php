<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Redirect;
use App\Models\Arbeitspaket;


class PlanungsController extends Controller
{
        /**
     * Zeigt die Karten aller gespeicherten Arbeitspakete an
     * Paginierung auf 9 Elemente
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        if(isset($request->action)) {
            if($request->action == "drop_package") $success = $this->handle_package_drop($request->parameters);

        }

        $pakete=Arbeitspaket::all();

        return Inertia::render('Planung', [
            'pakete' => $pakete->toArray(),
            'piedata' => $this->create_piedata($pakete),
        ]);
    }

    /**
     * Prüft ob ein Arbeitspaket sich über mehrere Quartale erstreckt und
     * teils es entsprechend in Unterpakete (modifizierte Kopien) auf
     *
     * @return Collection
     */
    private function split_multi_quarter_packages($pakete)
    {
        $jahrespakete = [];

        foreach($pakete as $paket) {
            if($paket->quartal == 0) {
                array_push($jahrespakete, $paket);
                continue;
            }
            $termin = $paket->termin;
            if ($paket->termin === "durchgängig") $paket->termin="31.12.";
            $paket->termin.="2023";
            $paket->termin=strtotime($paket->termin);

            $terminquartal=4;
            if($paket->termin<=strtotime("31.03.2023")) $terminquartal=1;
            if($paket->termin<=strtotime("30.06.2023")) $terminquartal=2;
            if($paket->termin<=strtotime("30.09.2023")) $terminquartal=3;

            $anzahl_quartale=$terminquartal+1-$paket->quartal;

            if($anzahl_quartale == 1) {
                array_push($jahrespakete, $paket);
                continue;
            }

            for($zaehler = 0; $zaehler < $anzahl_quartale; $zaehler++) {

                $splitpaket=$paket->replicate();
                $splitpaket->quartal=$paket->quartal+$zaehler;
                $splitpaket->name.= " (Q:". $zaehler + 1 ."/". $anzahl_quartale .")";
                $splitpaket->termin=$termin." (".$anzahl_quartale." Quartale)";

                $splitpaket->ds_aufwand = round($splitpaket->ds_aufwand/$anzahl_quartale);
                $splitpaket->bi_aufwand = round($splitpaket->bi_aufwand/$anzahl_quartale);
                $splitpaket->ri_aufwand = round($splitpaket->ri_aufwand/$anzahl_quartale);
                $splitpaket->ripa_aufwand = round($splitpaket->ripa_aufwand/$anzahl_quartale);
                //dd($splitpaket);
                array_push($jahrespakete, $splitpaket);
            }
            //$paket->termin = $anzahl_quartale;

        }
        //dd($jahrespakete);
        return collect($jahrespakete);
    }

    /**
     * Erzeugt das Piechart Dataset für alle übergebenen
     * Arbeitspakete
     *
     * @return Array
     */
    private function create_piedata($pakete)
    {
        $capacities = $this->read_capacities();
        $dataset = $this->default_dataset();
        $pakete = $pakete->collect();

        $pakete=$this->split_multi_quarter_packages($pakete);

        foreach($pakete as $paket) {
            if($paket->quartal == 0) continue;
            $season="q".$paket->quartal;

            if($paket->bi_aufwand>0) {
                array_push($dataset[$season]["bi"]["tasks"], [
                    "name" => $paket->name,
                    "prozent" => $paket->bi_aufwand
                ]);
                array_push($dataset[$season]["bi"]["colors"], $paket->chartcolor);
            }

            if($paket->ri_aufwand>0) {
                array_push($dataset[$season]["ri"]["tasks"], [
                    "name" => $paket->name,
                    "prozent" => $paket->ri_aufwand
                ]);
                array_push($dataset[$season]["ri"]["colors"], $paket->chartcolor);
            }

            if($paket->ds_aufwand>0) {
                array_push($dataset[$season]["ds"]["tasks"], [
                    "name" => $paket->name,
                    "prozent" => $paket->ds_aufwand
                ]);
                array_push($dataset[$season]["ds"]["colors"], $paket->chartcolor);
            }

            if($paket->ripa_aufwand>0) {
                array_push($dataset[$season]["ripa"]["tasks"], [
                    "name" => $paket->name,
                    "prozent" => $paket->ripa_aufwand
                ]);
                array_push($dataset[$season]["ripa"]["colors"], $paket->chartcolor);
            }

        }

        foreach ($dataset as $quarterkey => $quarter) {
            foreach ($quarter as $groupkey => $group) {
                $capacity=$capacities[$quarterkey][$groupkey];
                $sum=0;
                foreach($group["tasks"] as $paket) {
                    $sum = $sum+$paket["prozent"];
                }
                $newgroup=[];
                foreach($group["tasks"] as $paket) {
                    array_push($newgroup, [
                        "name" => $paket["name"],
                        "prozent" => round($paket["prozent"]/$capacity*100)
                    ]);
                }
                if($capacity>0) {
                    if($sum<$capacity) {
                        array_push ($newgroup, [
                            "name" => "Freie Kapazität",
                            "prozent" => round(($capacity-$sum)/$capacity*100)
                        ]);
                        $dataset[$quarterkey][$groupkey]["tasks"]=$newgroup;
                        array_push($dataset[$quarterkey][$groupkey]["colors"], "#eeeeee");
                    }
                    else {
                        array_push ($newgroup, [
                            "name" => "Überbuchung",
                            "prozent" => round(($sum-$capacity)/$capacity*100)
                        ]);
                        $dataset[$quarterkey][$groupkey]["tasks"]=$newgroup;
                        array_push($dataset[$quarterkey][$groupkey]["colors"], "#f60101");
                    }
                }
            }
        }

        return $dataset;

    }



    /**
     * Verarbeitung des Drops von einem Paket in eine Plaungsspalte
     * zur Planung in- oder aus einem Quartal
     *
     * @return Bool
     */

    private function handle_package_drop($parameters)
    {

        $paket=Arbeitspaket::where("import_id", $parameters["id"])->first();
        $paket->quartal = $parameters["quartal"];

        return $paket->save();
    }

        /**
     * Reads the capacities from the database
     * for the Piechart calculations
     *
     * @return Array
     */
    private function read_capacities()
    {
        return [
            "q1" => [
                "bi"=> 100,
                "ri"=> 100,
                "ds"=> 100,
                "ripa"=> 100,
            ],
            "q2" => [
                "bi"=> 100,
                "ri"=> 50,
                "ds"=> 100,
                "ripa"=> 100,
            ],
            "q3" => [
                "bi"=> 100,
                "ri"=> 100,
                "ds"=> 100,
                "ripa"=> 100,
            ],
            "q4" => [
                "bi"=> 100,
                "ri"=> 100,
                "ds"=> 100,
                "ripa"=> 100,
            ]
        ];
    }

    /**
     * Sets up the default dataset structure
     * for the Piecharts
     *
     * @return Array
     */
    private function default_dataset()
    {
        return [
            "q1" => [
                "bi"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ri"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ds"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ripa"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
            ],
            "q2" => [
                "bi"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ri"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ds"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ripa"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
            ],
            "q3" => [
                "bi"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ri"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ds"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ripa"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
            ],
            "q4" => [
                "bi"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ri"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ds"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
                "ripa"=> [
                    "tasks"=>[],
                    "colors"=>[]
                ],
            ],
        ];
    }



}


