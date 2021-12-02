<?php
    namespace App;

    use App\Request;
    

    final class App{
        static protected $action;
        static protected $req;


        static function start(){
            $session=new Session();
            $routes=self::getRoutes();
           
            
            // obtenir tres parámetres: controlador, accio,[parametres]
            // url friendly :  http://app/controlador/accion/param1/valor1/param2/valor2
            self::$req=new Request;
            $controller=self::$req->getController();
            
            self::$action=self::$req->getAction();
         
            self::dispatch($controller,$routes,$session);

        }
        
        private static function dispatch($controller,$routes,$session):void 
        {
            
            try{
                if(in_array($controller,$routes)){
                   // si es ruta de sistema es pot instanciar
                   // dispatcher
                   $nameController='\\App\Controllers\\'.ucfirst($controller).'Controller';
                   $objContr=new $nameController(self::$req,$session);
                   
                   //comprovar si existeix l'acció como mètode a l'objecte
                   if (is_callable([$objContr,self::$action])){
                       call_user_func([$objContr,self::$action]);
                   }else{
                       call_user_func([$objContr,'error']);
                   }

               }else{
                    throw new \Exception("Ruta no disponible");
                }
           }catch(\Exception $e){
               die($e->getMessage());
           }
        }
        /**
         *  register all available routes in controllers folder
         *  @return array $routes[]
         */
        static function getRoutes(){
            $dir=__DIR__.'/Controllers';

            $handle=opendir($dir);
            while(($entry=readdir($handle))!=false){
                if ($entry!='.' && $entry!='..'){
                    $routes[]=strtolower(substr($entry,0,-14));
                }
               
            }
            return $routes;
        }
    }