

1. The following directories must be writable by the Apache Server for all environments
   - website/runtime
   - website/web/assets

2. The web site should only publish the website/web directory.

3. The local-templates directory contains files that will need to be customized for the 
   specific machine and moved to the appropriate directory for the application to work.
    
4. For Development environment set 2 environment variables:
   YII_DEBUG = true  (defaults to false)
   YII_ENV = dev     (defaults to prod)

   in the Apache configuraion you can use:
     SetEnv YII_DEBUG true
     SetEnv YII_ENV "dev"



