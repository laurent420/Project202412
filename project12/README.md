<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
 
## Instalatie van Laravel
(https://laravel.com/docs/11.x/installation)composer install 

We gaan beginnen met het installeren van Xampp. Xampp is een lokale server voor Windows en Linux.
U moet gewoon de stappen van Xampp zelf volgen.
https://www.apachefriends.org/download.html
Indien u werkt met MacOs moet u Mamp gebruiken:
https://www.alternate.be/html/product/1851237?utm_source=Tweakers&utm_medium=cpc&utm_campaign=Tweakers_SSD&utm_term=IMKMIF

Na het instalern van Xampp moet je de files van github downloaden. Deze moet je dan plaatsen in de htdocss van Xampp. Dit is te vinden in de verkenner van je pc.
Bv: C:\xampp\htdocs
Nu kan je de Laravel files downloaden van github:
https://github.com/laravel/laravel.git
Nu kan je de Laravel files plaatsen in de htdocs van Xampp.
Vergeet zeker en vast niet om ook Apache ne MySql op te starten in je Xampp.

Nu gaan we laravel en al de rest installeren zodat we deftig kunnen werken met het installeren van PHP en composer. Dit is het gemakkelijkste via Laravel Herd. (https://herd.laravel.com/windows)    
Voor ons programma is het installeren van node en npm ook belangrijk.(https://nodejs.org/en)

Daarna gaan we breeze installeren. Breeze is een starters pakket van Laravel. Hiervoor gaan we een paar commandos moeten gebruiken in de terminal van het project.
Begin met er voor te zorgen dan je in de juiste file zit in de terminal. Als dit niet zo is moet je eerst met het "cd" commando navigeren naar de correcte file.

Eenmaal dat dit gelukt is moet je volgende commando's gebruiken:
1. composer require laravel/breeze --dev

2. php artisan breeze:install

Dit is voor de npm gewoon voor de zekerheid dat hij echt geinstalleerd is.
3. npm install

Normaal gezien is alles nu geinstalleerd en zou alles moeten werken. Stel dat dit niet het geval is controlleer dan even of alles is geinstaleerd. dit kun je doen aan de hand van -v.
Bv: composer -v
Als je dit dan runt dan kunnen er meerdere dingen gebeuren als je effectief een versie nummer of een reeks files te zien krijgt. 
Als dit niet het geval is dan ligt je fout waarschijnlijk daar. Doe de instalatie nogmaals opnieuw. 
Als u nog steeds een probleem aarzal dan niet om mij te contacteren om te helpen troubleshooten op mijn e-mail (thomas.de.neef@student.ehb.be)

Nu dat alles werkt en geinstalleerd is kunnen we het programma starten.
Begin met het volgende commando:
"npm run dev" en daarna "php artisan serve"
npm zorgt dat alle opmaak werkt. php artisan serve zorgt ervoor dat de server lokaal begint te draaien.
Nu kan je het programma openen in je browser door naar "localhost:8000" te gaan of door op de link van de artisan serve te klikken.

Nu gaan we de migration doen. De migration is de aanmaak van je database in.
Eerst moeten we de .env file aanpassen. Dit is een file dat ervoor zorgt dat je verbinding hebt met de database.
Om een idee te krijgen hoe de .env file er moet uitzien moet u kijken op op de teams waar u een voorbeeld kan vinden.

Eenmaal u de .env file inorde heeft gezet kan u een migrate uitvoeren.
Dit gaat als volgt u gaat in de terminal in de juiste folder. Dan doet u php artisan migrate.
Mocht dit niet werken doet u php artisan migrate:fresh

Nu zou alles moeten werken indien niet overloop dan nogmaals alle stappen.


## Uitleg van alle pagina's
    1. Dashboard
        Admin
            Als admin heb je op het dashboard meerdere functies.
            Je kunt namelijk items toevoegen dit doe je door de "Add item" knop. Als je hierop klikt begeeft u zich naar een andere pagina. Hier geef je het merk en de naam van het aparaat in. Dit maakt of een groep aan van dit item of plaatst het item in een al bestaande groep.
            Als je eenmaal zo een item groep hebt dan zie je deze verschijnen op het dashboard. Links beneden bij je item groep een knop met de naam "Details" wanneer deze knop wordt geactiveerd dan krijgt u een ovezicht van alle items dat in deze groep zitten. Hier kan u ook kiezen specifieke items te verwijderen.
        Gebruiker
            Als je gebruiker bent dan heb je enkel de mogelijkheid om de items te zien en kun je ze toevoegen aan of je favorieten lijst of aan je winkel mand.
            Je hebt ook de zoekbalk. Je kan zowel naar merk als naar naam zoeken.

    2. My cart
        Gebruiker
            My cart is alleen besckbaar als gebruiker. Hierin zie je alle items dat je in je winkelmand hebt gezet. Je kan deze verwijderen. Maar je hebt ook de mogelijkheid om deze te boeken. Eerst selecteer je een datum daarna op Lend klikken, ziezo dat is hoe sempel het is om een item te lenen.

    3. Favorieten
        Gebruiker
            In de favorieten zie je alle item groepen dat hebt je gefavoritiseerd. Je kan ze via hier in je winkelmand zetten of ze uit je favorieten lijst halen.

    4. Loaned items
        Amdin
            Als admin zie je in loaned items alle items dat door alle personen zijn uitgeleend. Je kan hierin zoeken.
        Gebruiker
            Als gebruiker zie je alle items dat jijzelf hebt uitgeleend.

    5. Users
        Admin
            Als admin kan je hierin alle gebruikers zien. Je kan ze hier bannen. Bij de ban moet je een reden opgeven. Eenmaal je een ban hebt gegeven krijgt deze gebruiker te zien van wanneer tot wanneer hij/zij is gebanned en ook waaarom.
            Je kan ook mensen hun ban terug intrekken.
    6. Info
        Gebruiker
            Als gebruiker vindt je hier alle handige informatie in terug over het MediaLab.

## Alle gebruikte externe documentatie

## Laurent: 
https://chatgpt.com/share/66033690-808d-4256-b2c0-d6ad4283fb3f
https://chatgpt.com/share/662c5f81-b577-4bbf-8de8-acbc5d776a83
https://chatgpt.com/share/8323dbde-e9b2-4153-bcff-dbba335b8753
https://chatgpt.com/share/ca36b012-0400-48fe-9ff2-d51b0f50158a
https://chatgpt.com/share/b31b2e89-325f-4d36-89f0-d90f2ba36cc6

## Eden: 
https://chatgpt.com/share/5a39d7cc-5e22-43bd-89c1-f6e71b54377c
https://chatgpt.com/share/34a7a444-43f1-4dba-afa4-105600a5c21d
https://chatgpt.com/share/c8988ed5-c2ca-4002-a6c2-1991e79e790a
https://chatgpt.com/share/daea5c8c-56b1-4245-a34e-ab18617e3825

## Safwane: 
https://chatgpt.com/share/50b1954e-573e-44f1-81d2-87490edf136f
https://chatgpt.com/share/93e0eb43-ea7c-4970-9258-6a1290aaa6a1
https://chatgpt.com/share/10e846b8-feb0-4249-8321-009f8b7d62c4
https://chatgpt.com/share/2d065a77-4513-414a-83e4-601697c406b8
https://www.w3schools.com/tags/tag_button.asp

## Mohamed: 
https://chatgpt.com/share/72233da5-df4c-4c68-b90d-b5d47f915897 
https://chatgpt.com/share/abe3b568-8868-4a02-953d-0fbe321c2a08
(gebruik van github copilot)

## Thomas De Neef
https://stackoverflow.com/questions/63807930/error-target-class-controller-does-not-exist-when-using-laravel-8

https://blackbox.ai/share/ba8abb08-5892-4fad-92a4-837dd135c3b1
https://blackbox.ai/share/3d42b751-06b0-4fba-9ad4-09859176b9ec
https://blackbox.ai/share/5b117061-0b97-45a1-b30e-8f7d054eed52

https://chatgpt.com/share/31a1d6dd-451b-4f1e-8e05-fdc4fde9dac5
https://chatgpt.com/share/e8873e86-f041-4771-93df-8a1132dd5f44
https://chatgpt.com/share/5493581b-a46b-4dac-9c39-0e3d26bef304
https://chatgpt.com/share/50dd2c6a-87c8-4e28-86ca-2a56ea95b81d
https://chatgpt.com/share/7abd73b4-d7f3-468d-9ea8-4a4897c05f2f
https://chatgpt.com/share/0d1839a9-bd65-4a2a-8269-54256a458779
https://chatgpt.com/share/b567c426-2d7f-493d-b46b-88aa4c67ab54
https://chatgpt.com/share/270cda04-f86b-49d2-97d4-c067df12467c
https://chatgpt.com/share/ede77e52-e057-460e-87c2-40ed93379162
https://chatgpt.com/share/d011aecc-bcf0-4ac6-bab8-42a19a0548ce
https://chatgpt.com/share/e002db76-f46c-4916-83ac-975429283caa
https://chatgpt.com/share/7b44b912-29dd-4602-9983-8748df4e0513
https://chatgpt.com/share/625a30e2-bb5e-4459-ade8-7d6dd90c2039
https://chatgpt.com/share/9826bf99-d35f-4e3c-b6fb-67fa84af9e4f
https://chatgpt.com/share/52cd794a-acc7-41c6-8b2a-d4a30d632e4d
https://chatgpt.com/share/41e1cd2e-c72e-445a-965c-dfcb0119cd36
https://chatgpt.com/share/a199d3fd-1f2b-4404-bd42-e9d60ae82284
https://chatgpt.com/share/914d4af1-1ccc-4b1b-8090-e5cece43f7dd
https://chatgpt.com/share/fa82645c-e9aa-458d-83b3-30134b9e2693
https://chatgpt.com/share/b0c917f9-0f99-40cf-8969-593014f1ee31
https://chatgpt.com/share/6d837c53-aa9a-415c-9771-f33a6eb595bb
https://chatgpt.com/share/ec1d06e4-ad90-4d91-9a3e-2ac9e19e44d7
https://chatgpt.com/share/b065a1aa-143b-49d8-9082-a018416c3f8a
https://chatgpt.com/share/78cd3106-ba7f-40e3-8383-3a6fbe90f1e0
https://chatgpt.com/share/f78edf90-dfab-484e-b534-a48a038344d2
https://chatgpt.com/share/4520f914-2048-45b3-a6fe-b3d7a3f137dd
https://chatgpt.com/share/b68c5368-c503-4ffb-9119-cb2abfcfc82b
https://chatgpt.com/share/d5b2f602-ab50-468a-8dd7-40dd54b1526e
https://chatgpt.com/share/39f7c74c-c8d4-41a7-8c1a-642a362e5cd1
https://chatgpt.com/share/dc74a2c6-bad2-41e6-9c66-bc5063420aaa
https://chatgpt.com/share/e2802f68-35dc-493e-943a-9057197e597c
https://chatgpt.com/share/759a5e36-b644-4725-8fb5-15a0a28b5124
https://chatgpt.com/share/1a515c76-7ac5-4442-baec-009ab19fafa9
https://chatgpt.com/share/7371de9d-47e4-4699-91f4-fca3c2fad487
https://chatgpt.com/share/fb4a671f-4c98-4bc9-b744-b354ff501d94
https://chatgpt.com/share/91b6a8ae-81ac-4681-a07b-c5db9742db88
https://chatgpt.com/share/5fc6631f-387e-4277-976d-2e07ef5d679f
https://chatgpt.com/share/bd935368-f45e-4f9c-b9d7-4d122c3678e0
https://chatgpt.com/share/c7447c97-c3f7-4b14-a654-cfe33c04ab9c
https://chatgpt.com/share/d008b0ef-8200-4707-ad8a-d4633f51488c
https://chatgpt.com/share/beadeb39-3f73-4525-a743-7ed6127ac102
https://chatgpt.com/share/7f8f8854-d813-48ed-b473-a6333a20d760
https://chatgpt.com/share/e4aa5f45-2468-4ee4-b3bb-02cb91949cba
https://chatgpt.com/share/23a89eec-b0f7-48ac-b49b-0310627e8238
https://chatgpt.com/share/80fd8f9b-04ad-444f-b9a4-88fd7a311a40
https://chatgpt.com/share/7c913f57-9ce4-436b-be83-77e56430ee66
https://chatgpt.com/share/1b817169-c22b-4c0c-9684-fa7c612f07cc
https://chatgpt.com/share/a70ffccf-2d2a-4faf-aa67-3d1693db673a
https://chatgpt.com/share/47bbf7a7-955e-4a69-a09e-557dfb99253d
https://chatgpt.com/share/bad425d6-ba63-4748-ac0f-6ff7a78e2870
https://chatgpt.com/share/d97fc53a-9a4b-4e8e-9b74-5cff40646ac0
https://chatgpt.com/share/b523b992-e6cf-49c4-ad49-27365c58ace1
https://chatgpt.com/share/48b1f72e-c634-4e11-bca8-3cb3c5586358
https://chatgpt.com/share/7f3b56e1-5447-4726-95c8-9d9d41b83061
https://chatgpt.com/share/018b2fd3-0ee6-436e-be32-139392b15fc0
https://chatgpt.com/share/70115ea5-4fda-4f0c-9236-aaf0f6a83e3a
https://chatgpt.com/share/7898e840-bde0-49e8-af2d-89d9226a4d60
https://chatgpt.com/share/75ae064e-4edb-4663-a250-8de2464d807d
https://chatgpt.com/share/b218a3e5-5d13-408f-a4bc-085e633ce88a
https://chatgpt.com/share/b8e73f24-611a-43bc-8c9e-1a4efd066e9d
https://chatgpt.com/share/7241b363-3d2d-4e61-b772-dd818fa343a7
https://chatgpt.com/share/4a186f37-3522-4683-90a8-b671611bbb98
https://chatgpt.com/share/d88dbd26-b13a-49f3-8e7f-8662b49f9711
https://chatgpt.com/share/b89aa210-bf0e-4923-abd6-ad3af6d1589f
https://chatgpt.com/share/e13fbf15-0301-42da-b4bf-01b40fbdc30b
https://chatgpt.com/share/d557682b-8ee2-4c94-8ec8-a6c6c5680fe3
https://chatgpt.com/share/a966f2a3-3bad-4a45-90cd-7facf1bf4457
https://chatgpt.com/share/89b02c30-6b09-4bda-8160-b6097b7e3178
https://chatgpt.com/share/13e15f9e-2916-4e8f-915c-c31fdc6674ea
https://chatgpt.com/share/9cb2ee8f-c272-423b-8e22-1c519be6cebd
https://chatgpt.com/share/8b7dcbee-fd73-4494-a34a-f99ef194ac7c
https://chatgpt.com/share/1700d2a5-18f2-4a49-80e4-b9b4814ae239
https://chatgpt.com/share/ca449c91-6be3-4cde-a97e-0c6a10cdfeb5
https://chatgpt.com/share/d0739b84-a353-4680-b177-008287734ef3
https://chatgpt.com/share/d3f47561-7e31-48c1-8e53-2a292d14fc86
https://chatgpt.com/share/e78cc91a-266f-4c6f-8ab6-8dd4d704a062
https://chatgpt.com/share/476659cd-25a3-40df-8c6e-cf833a32093e
https://chatgpt.com/share/3b9ff080-45c6-4300-b97d-d77fb78cde84
https://chatgpt.com/share/d3c5561e-6272-4e43-a3c8-67d5b8fd7145
https://chatgpt.com/share/f7afa7fb-966e-4f24-943e-3975ab2b2d0f
https://chatgpt.com/share/976382b5-26e4-4564-9eff-3b7193558b59
https://chatgpt.com/share/6049b334-20b8-499f-95db-b155406ce68f
https://chatgpt.com/share/0be7887d-3b57-4f2a-ba5b-c68f5cff46a4
https://chatgpt.com/share/4e697820-c00e-47bc-8378-3871b091b81d
