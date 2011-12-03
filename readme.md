YAMVVMF is Yet another (simple!) model-view-view model framework for PHP.

I've desided to write it when I wanted to open a blog and looked over for a framework to start with, I saw that nothing is really simple as much as I want.

So i've written YAMVVMF, It contains : 

-    Routes
-    Controllers
-    Simple Configuration
-    Views (JSON -> Json Decode, HTML -> Twig)
-    IoC Containers (Based on https://github.com/Elfet/IoC)
 
I do want to add : 

-    Unit tests
-    Restless routes
 
How to use it? Add routes :

    "index/id" : {
        "id" : "\\d+",
        "controller" : "index",
        "action" : "getById",
        "formats" : ["HTML","JSON"]
    }
    
Then you can navigate with your browser like that :

    http://www.mywebsite.com/index/5

To choose the format, add it to the end of the URI with "." as prefix :

    http://www.mywebsite.com/index/5.json
    
It will serve the page with JSONView (lib/YAMVCF/Views/JSONView.php)

The Bootstrapping process :

1.    Finding the right route from config/routes.json
2.    Loading the controller
3.    Calling $controller->$action
4.    Creating the right view from the format (Right now there is only support for html/json)
5.    Get all the exports from the controller and pour it into the view
6.    Calling the view (The view has only $controllerName, $actionName, $exports)
7.    Thats it, Page is served!

Enjoy it.
    
    


