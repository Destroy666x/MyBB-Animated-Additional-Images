<?php

/*
Nazwa: Animowane dodatkowe grupy
Autor: Destroy666
Wersja: 1.0
Wymagania: Plugin Library
Informacje: Plugin dla skryptu MyBB, zakodowany dla wersji 1.8.x (może także działać w 1.6.x/1.4.x).
Wyświetla obrazki dodatkowych grup w formie "karuzeli" JS.
3 nowe szablony, 5 zmian w szablonach, 7 nowych ustawień
Licencja: GNU GPL v3, 29 June 2007. Więcej informacji w pliku LICENSE.md.
Support: officjalne forum MyBB - http://community.mybb.com/mods.php?action=profile&uid=58253 (nie odpowiadam na PM, tylko na posty)
Zgłaszanie błędów: mój github - https://github.com/Destroy666x

© 2015 - date("Y")
*/

$l['animated_additional_images'] = 'Animowane dodatkowe grupy';
$l['animated_additional_images_info'] = 'Wyświetla obrazki dodatkowych grup w formie "karuzeli" JS.';
$l['pluginlibrary_missing'] = '<strong>Uwaga:</strong> Modyfikacja wymaga biblioteki Plugin Library do dodawania/usuwania szablonów. Można ją pobrać <a href="https://github.com/frostschutz/MyBB-PluginLibrary/archive/master.zip">tutaj</a>.';

$l['animated_additional_images_settings'] = 'Ustawienia dla pluginu "Animowane dodatkowe grupy".';
$l['animated_additional_images_posts'] = 'Włącz animowane dodatkowe grupy we wszystkich postach?';
$l['animated_additional_images_posts_desc'] = 'Ustaw na tak aby włączyć plugin w postach.';
$l['animated_additional_images_profile'] = 'Włącz animowane dodatkowe grupy we wszystkich profilach?';
$l['animated_additional_images_profile_desc'] = 'Ustaw na tak aby włączyć plugin w profilach.';
$l['animated_additional_images_memberlist'] = 'Włącz animowane dodatkowe grupy w liście użytkowików?';
$l['animated_additional_images_memberlist_desc'] = 'Ustaw na tak aby włączyć plugin w liście użytkowników.';
$l['animated_additional_images_announcements'] = 'Włącz animowane dodatkowe grupy we wszystkich ogłoszeniach?';
$l['animated_additional_images_announcements_desc'] = 'Ustaw na tak aby włączyć plugin w ogłoszeniach.';
$l['animated_additional_images_pms'] = 'Włącz animowane dodatkowe grupy we wszystkich prywatnych wiadomościach?';
$l['animated_additional_images_pms_desc'] = 'Ustaw na tak aby włączyć plugin w prywatnych wiadomościach.';
$l['animated_additional_images_previews'] = 'Włącz animowane dodatkowe grupy we wszystkich podglądach?';
$l['animated_additional_images_previews_desc'] = 'Ustaw na tak aby włączyć plugin w podglądach.';
$l['animated_additional_images_time'] = 'Czas zmiany obrazka';
$l['animated_additional_images_time_desc'] = 'Podaj liczbę większą niż 0, reprezentującą liczbę milisekund [ms], po których obrazek grupy jest zastąpiony następnym (o ile są przynajmniej 2).';
$l['animated_additional_images_pause'] = 'Pauzuj animację myszą';
$l['animated_additional_images_pause_desc'] = 'Czy rotacja ma być chwilowo wstrzymywana gdy bieżący obrazek grupy jest wskazywany przez kursor?';