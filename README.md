# TDMS
TURQ Development Module Sidebar

<img src="https://github.com/TurqDevDesign/tdms/blob/master/tdms_functions/tdms_setup/images/tdms_logo.png" alt="TDMS Logo" width="250"/>

This is the git repository for the TURQ Development Module Sidebar. 

Though it's currently still in production, TDMS is meant to be an easy-to-use, easy-to-implement, developer-centric content management system. The ultimate goal is to have an easily extendable, bare-bones CMS that implements a wide range of ready-made functions, on top of, and improving upon, many other features we've all come to know and love from other popular systems. 

### Current Installation instructions

As of now there is no automated manner of installing this application.

You must first take the *tdms_sidebar* folder and place it within your public HTML directory on your server. 
* You can rename this folder if you want, to suit your needs.
* Currently, TDMS keeps this folder name in the URL.

Next, you must place the *tdms_functions* folder just outside of your public HTML (generally the same directory as the public HTML folder).
* This folder houses the configuration files where database information is stored. TDMS is designed to have this information as secure as possible, hence having it stored outside of the public HTML.
* This folder also houses all of the backend files for the TDMS system, excluding the module (plugin) directory, and the tdms_info.json file, as they are specific to each installation. Placing these files separate from the site-specific information helps to avoid duplicating 40+ MB for each site, when the files will never change outside of updates. 


### Disclaimer

This application is nowhere near completed at the moment. You can install it, but it won't do much for you.

