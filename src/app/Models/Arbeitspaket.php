<?php

namespace App\Models;

use App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbeitspaket extends Model
{
    use HasFactory;

    //Parameter Setting
    protected $tagessatz = 0;

    // Zusätzliche Felder
    protected $appends = [
        'budget_teur',
        //'quartal'
    ];

    // Tabelle in DB
    protected $table = 'arbeitspakete';

    /**
     * Konstruktor mit Setzen der Basis - Parameter;
     *
     * @return null
     */
    public function __construct(){
        $this->tagessatz = env ('KALKULATION_TAGESSATZ', 1000);
        return null;
    }

    /**
     * Berechnung des zusätzlichen Felds budget_teur
     *
     * @return bool
     */
    public function getBudgetTeurAttribute()
    {
        return intval( round($this->budget*$this->tagessatz/1000) );
    }

    /**
     * Berechnung des zusätzlichen Felds quartal
     *
     * @return bool
     */
    #public function getQuartalAttribute()
    #{
    #    return  rand(0,4);
    #}

    /**
     * Setzen der Default-Werte für ein neues Arbeitspaket
     *
     * @return bool
     */
    public function initialize() {
        #$this->name="Neues Arbeitspaket";
        #$this->kategorie="Instandhaltung des Betriebs";
        #$this->beschreibung="An dieser Stelle findet sich die Beschribung des Zielzustandes für das Projekt (Scope)";
        #$this->kommentar="Hier kann ein Kommentar vermerkt sein";

        $this->termin="31.12.";
        $this->ds_aufwand=-1;
        $this->bi_aufwand=-1;
        $this->ri_Aufwand=-1;
        $this->ripa_aufwand=-1;

        // Assign random pastel color
        $r = dechex(rand(127, 256));
        $g = dechex(rand(127, 256));
        $b = dechex(rand(127, 256));
        $this->chartcolor = "#".$r.$g.$b;

        return $this->save();

    }

    /**
     * Erstellung eines Duplikates von einem Arbeitspaket
     *
     * @return bool
     */
    public function duplicate() {
        $paket = $this->replicate(); // Replizieren des aktuellen Arbeitspakets in ein Neues

        // Anhang des nummerierten Kopie-Zählers -> (Kopie) ... (Kopie 2) ...
        $counter="";
        $basename=$paket->name;
        if(strstr($basename, " (Kopie")) {
            $name=explode(" (Kopie", $basename);
            $basename=$name[0];
            if(substr(trim($name[1]),0,1)<>")") {
                $name=explode(")", trim($name[1]));
                $counter=" ".intval($name[0]+1);
            } else $counter=" 2"; // "Kopie 1" existiert nicht; heisst stattdessen nur (Kopie)
        }

        $paket->edit_name ($basename." (Kopie{$counter})");
        return $paket->save();

    }

   /**
     * Bearbeitung des Feldes "import_id"
     *
     * @return bool
     */
    public function edit_import_id($text) {
        $this->import_id = $text;
        return $this->save();
    }

    /**
     * Bearbeitung des Feldes "name"
     *
     * @return bool
     */
    public function edit_name($text) {
        $this->name = $text;
        return $this->save();
    }

   /**
     * Bearbeitung des Feldes "termin"
     *
     * @return bool
     */
    public function edit_termin($text) {
        $termin=$text;
        if(strstr($termin, "." ) || strstr($termin, "-" )) {
            if(strstr($termin, "." ) && strstr($termin, "-" )) {
                // Do nothing
            } else {
                // Termin Strich zu Punkt > Explode > Format
                $termin = str_replace("-", ".", $termin);
                $termin = explode(".", $termin);
                $termin=$termin[0].".".$termin[1].".";
            }
        }
        $this->termin = $termin;
        return $this->save();
    }

   /**
     * Bearbeitung des Feldes "kategorie"
     *
     * @return bool
     */
    public function edit_kategorie($text) {
        $this->kategorie = $text;
        return $this->save();
    }

   /**
     * Bearbeitung des Feldes "budget"
     *
     * @return bool
     */
    public function edit_budget($text, $feld="pt") {
        $budget=$text;
        if($feld=="teur") $budget=$text*1000/$this->tagessatz;
        $this->budget = $budget;
        return $this->save();
    }

    /**
     * Bearbeitung des Feldes "beschreibung"
     *
     * @return bool
     */
    public function edit_beschreibung($text) {
        $this->beschreibung = $text;
        return $this->save();
    }

   /**
     * Bearbeitung des Feldes "kommentar"
     *
     * @return bool
     */
    public function edit_kommentar($text) {
        $this->kommentar = $text;
        return $this->save();
    }

   /**
     * Bearbeitung des Feldes "ds_aufwand"
     *
     * @return bool
     */
    public function edit_aufwand($value, $gruppe, $indicator) {

        if(!is_numeric($value) || is_null($value)) {
            if($value=="y") $value=-1;
            else $value=0;
        }

        if ($gruppe=="ds") {
            $min=$this->ds_aufwand_min;
            $max=$this->ds_aufwand_max;
            $med=$this->ds_aufwand;
        }
        if ($gruppe=="bi") {
            $min=$this->bi_aufwand_min;
            $max=$this->bi_aufwand_max;
            $med=$this->bi_aufwand;
        }
        if ($gruppe=="ri") {
            $min=$this->ri_aufwand_min;
            $max=$this->ri_aufwand_max;
            $med=$this->ri_aufwand;
        }
        if ($gruppe=="ripa") {
            $min=$this->ripa_aufwand_min;
            $max=$this->ripa_aufwand_max;
            $med=$this->ripa_aufwand;
        }

        if($indicator=="absolute") {
            $min=0;
            $max=0;
            $med=$value;
        } else {
            if($indicator=="min") $min=$value;
            if($indicator=="max") $max=$value;

            if($min>$max) $max=$min;

            $med=round(($min+$max)/2);
        }


        if ($gruppe=="ds") {
            $this->ds_aufwand_min=$min;
            $this->ds_aufwand_max=$max;
            $this->ds_aufwand=$med;
        }
        if ($gruppe=="bi") {
            $this->bi_aufwand_min=$min;
            $this->bi_aufwand_max=$max;
            $this->bi_aufwand=$med;
        }
        if ($gruppe=="ri") {
            $this->ri_aufwand_min=$min;
            $this->ri_aufwand_max=$max;
            $this->ri_aufwand=$med;
        }
        if ($gruppe=="ripa") {
            $this->ripa_aufwand_min=$min;
            $this->ripa_aufwand_max=$max;
            $this->ripa_aufwand=$med;
        }

        return $this->save();
    }

}
