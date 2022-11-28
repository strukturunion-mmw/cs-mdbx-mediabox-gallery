 # MediaBox Website

Prognoseplanung 2023 

Planungstool für Prognose-Gruppen basierend auf Quaertalen

Auftraggeber: strukturunion gmbh
Entwickler: strukturunion gmbh | www.strukturunion.de

## Installation
Run in terminal: 

`echo "alias sail='[ -f sail ] && sh sail || sh src/vendor/bin/sail'" >> ~/.bashrc`

`echo "alias up='/workspaces/cs-ri-prognose-planung-2023/up.sh'" >> ~/.bashrc`

`sh /workspaces/cs-ri-prognose-planung-2023/credentials_restore.sh`

Exit and run in NEW terminal:

`mv /workspaces/cs-ri-prognose-planung-2023/src/vendor.setup /workspaces/cs-ri-prognose-planung-2023/src/vendor`

`/workspaces/cs-ri-prognose-planung-2023/up.sh`

`cd ./src` 

`sail composer --ignore-platform-req=ext-gd install`

`sail npm install`

`sail npm run build`

Restart Sail environment


## Usage
- run `up` to spin up local environment
- Take down with `CTRL-C`
- Deploy using GoogleCloud Plugin (test/prod .env Files are copied in buld process)

## Cloudrun Configuration
- Ausführungsumgebung: **Zweite Generation (!)**
- CPU-Zuweisung: CPU wird nur während der Anfrageverarbeitung zugewiesen (default)
- CPU-Boost beim Starten: Deaktiviert (default)
- Gleichzeitigkeit; 80 (default)
- Zeitüberschreitung bei Anfrage: **15 seconds (!)**
- Ausführungsumgebung: **Zweite Generation (!)**
- Instanz-Mindestanzahl: **1 (!)**
- Max. Instanzenanzahl: **5 (!)**
- Port: **80 (!)**
- CPU-Limit: 1 (default)
- Arbeitsspeicherlimit: 512MiB (default)

## Comments
- Set up local Sail Env and Cloudrun prod deployments


<br><hr>
// ITEOTWAWKI  
// It's the end of the World as we know it 🤔  
// But I feel fine!