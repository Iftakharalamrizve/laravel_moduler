<?php


namespace App\Traits;

use File;
use Artisan;
use Illuminate\Support\Str;
trait RepositoryPattern
{




     /**
     * The protected array define all necessary file folder hints
     *
     * @var array
     */
    protected $repositoryPattern = [
        'Interfaces',
        'Repositories',
        'Request',
        'Controller',
        'views'
    ];

    /**
     *this method user for build structure for repository pattern
     *
     * @var
     */
    public function RepositoryPatternGenerate($moduleName){

        foreach ($this->repositoryPattern as $key=>$item){
            switch ($key){
                case 0:
                    $ModelFolderPath="/".$item;
                    $this->makeFolderOrDirectory($ModelFolderPath);
                    $this->InterfaceGenerator($moduleName);
                    break;
                case 1:
                    $ModelFolderPath="/".$item;
                    $this->makeFolderOrDirectory($ModelFolderPath);
                    $this->RepositoryGenerator($item,$ModelFolderPath,$moduleName);
                    break;
                case 2:
                    break;
                case 3:
                    break;
            }
        }
    }

    public function getStub($type, $stubName)
	{
		return file_get_contents(app_path('Stubs/' . $type . '/' . $stubName . '.text'));
	}





    public function InterfaceGenerator($moduleName){

        $interFaceText=$this->getStub("Interface","Interface");
        $moduleName=Str::singular(ucfirst($moduleName));
        $interFaceTemplate = str_replace ( [ '{ModuleName}' ] , [ $moduleName ] , $interFaceText );
        $filePath='/Interfaces/'.$moduleName.'.php';
        $this->makeFile($filePath);
        file_put_contents(app_path('/Interfaces/'.$moduleName.'.php'),$interFaceTemplate);
        $this->info("Your Interface create Successfully");
    }


    public function  RepositoryGenerator($interFacePath,$modulePath,$moduleName){
        $repositoryText=$this->getStub("Repository","Repository");
        $moduleName=Str::singular(ucfirst($moduleName));
        $repositoryTemplate = str_replace ( [ '{ModuleName}','{InterFacePath}' ] , [ $moduleName,app_path($interFacePath)] , $repositoryText );
        $filePath=$modulePath.'/'.$moduleName.'.php';
        $this->makeFile($filePath);
        file_put_contents(app_path('/Interfaces/'.$moduleName.'.php'),$repositoryTemplate);
        $this->info("Your Repository create Successfully");
    }




}
