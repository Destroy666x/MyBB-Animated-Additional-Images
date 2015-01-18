**Animated Additional Images**
===============

![Animated Additional Images](https://raw.github.com/Destroy666x/MyBB-Animated-Additional-Images/master/preview1.png "Preview")

**Name**: Animated Additional Images  
**Author**: Destroy666  
**Version**: 1.0  

**Info**:
---------

Plugin for MyBB forum software, coded for versions 1.8.x (will probably also work in 1.6.x/1.4.x).  
It displays additional group images in postbit/memberlist/profile by using a "carousel" JS.  
3 new templates, 5 template edits, 7 new settings  
Released under GNU GPL v3, 29 June 2007. Read the LICENSE.md file for more information.  

**Support/bug reports**: 
------------------------

**Support**: official MyBB forum - http://community.mybb.com/mods.php?action=profile&uid=58253 (don't PM me, post on forums)  
**Bug reports**: my github - https://github.com/Destroy666x  

**Changelog**:
--------------

**1.0** - initial release  

**Requirements**:
-----------------

Plugin Library is required for template installation.  
You can download it here: https://github.com/frostschutz/MyBB-PluginLibrary/archive/master.zip  
Installation guide: https://github.com/frostschutz/MyBB-PluginLibrary/blob/master/README.txt  
After uploading it ignore the compatibility warning.  

**Installation**:
-----------------

1. Get Plugin Library (check Requirements section for more info).
2. Upload everything from upload folder to your forum root (where index.php, forumdisplay.php etc. are located).
3. Install and activate plugin in ACP -> Configuration -> Plugins.
4. Configure it.

**Templates troubleshooting**:
------------------------------

* Globally - add **{$additional_images_js}** to the headerinclude template.
* Showthread/PM/announcements/previews - add **{$post['additional_images_html']}** to postbit templates (postbit and postbit_classic by default)
* Profile - add **{$additional_images_html}** to the printthread template
* Memberlist - add **{$additional_images_html}** to any newreply template (newreply by default)

**Translations**:
-----------------

Feel free to submit translation to github in Pull Requests. Also, if you want them to be included on the MyBB mods site, ask me to provide you the contributor status for my project.

**Donations**:
-------------

Donations will motivate me to work on further MyBB plugins. Feel free to use the button in the ACP Plugins section anytime.  
Thanks in advance for any input.