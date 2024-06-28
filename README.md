# Basis webshop voor lessen webshop bouwen

## Vereisten

- **XAMPP** of een vergelijkbare lokale serveromgeving.
- Een code editor, zoals **Visual Studio Code** of **Sublime Text**.
- Basiskennis van PHP, MySQL en webontwikkeling.

## Installatie

1. **Projectbestanden Kopiëren**
    - Kopier alles naar de map **xampp/htdocs**.

2. **Database Configureren**
    - Open het bestand **core/db_connect.php** en verander de database-instellingen naar jouw lokale configuratie: **$dbhost**, **$dbuser**, **$dbpass**, **$dbname** en **BASEURL**, **BASEURL_CMS** en **BASEURL_LOGIN**.
    - Open het bestand **admin\core\header.php** en verander de db_connect naar jouw lokale configuratie.

3. **Start Apache en MySQL**
    - Start de **Apache** en **MySQL** services via het **XAMPP Control Panel**.

4. **Database Importeren**
    - Ga naar **phpMyAdmin**.
    - Maak een nieuwe database aan met de naam **tuinman**.
    - Importeer het bestand **database.sql** in de nieuwe database.

## Starten van applicatie

- Open je webbrowser en ga naar **https://localhost/[bestand_naam]**.
- De webshop zou nu moeten laden, Om naar admin pannel te gaan. Ga naar: **https://localhost/[bestand_naam]/admin**

## Wijzigingen aanmaken via admin panel

1. **Log in.**
    - Ga naar **https://localhost/[bestand_naam]/login/adminlogin** of **https://localhost/[bestand_naam]/admin**.
    - Log in met uw gebruikers naam en wachtwoord, verwijs hiervoor naar uw mail.

2. **Kies wat u wilt veranderen**
    - Wilt u uw Recensies aan passen? Ga naar de Tuin/review Pagina en klik op wijzigen, voor een nieuwe toevoegen scroll naar onder en klik op toevoegen.
    - Wilt u uw informatie veranderen? Ga naar de informatie pagina en verander het **Achterstuk**.
    - Wilt u mogelijk nieuwe klanten zien/berichten? Ga naar Contact Overzicht en dan kan u het lezen. De nieuwste staat boven aan.

3. **Hulp nodig of snap u iets niet**
    - Contacteer een van de beheerders: Tristan, Jesse of Jaedyn.

## Mappenstructuur

- ***admin*** 
    - Is het mapje waar het CMS (Content Management System) of Admin panel komt van de webshop.
- ***assets*** 
    - Hierin staan de css, js en images.
    - Ook staan hier de upload images die geupload worden vanuit het CMS
- ***core***
    - In dit mapje staat de database connectie.
    - De header en de footer van de HTML voorkant.
    - **admin/core** bevat nog een checklogin function file. 