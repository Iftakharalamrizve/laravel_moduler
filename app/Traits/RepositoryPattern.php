<?php


namespace App\Traits;

use File;
use App\Traits\CommonMethod as CommonTrait;
trait RepositoryPattern
{
    use CommonTraitr{
        //alis the commonMethod traits method name
        CommonTraitr::makeFolderOrDirectory insteadof MakeFolder;
        CommonTraitr::checkFileAlreadyCreateOrNot as FileStatus;
    }




     /**
     * The protected array define all necessary file folder hints
     *
     * @var array
     */
    protected $repositoryPattern = [
        'Interface',
        'Repository',
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
                    $ModelFolderPath="/Interfaces";
                    $this->MakeFolder($ModelFolderPath);
                    $this->InterfaceGenerator($moduleName);
                    break;
                case 1:
                    $ModelFolderPath="/Interface";
                    $this->MakeFolder($ModelFolderPath);
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
    }




}
