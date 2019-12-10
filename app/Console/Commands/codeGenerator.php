<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;
use Route;
use Artisan;
class codeGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pattern:web';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' This command use for auto generate and create folder structure ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //enter Pattern name
        $patternName = $this->ask('Enter Module Pattern Name :');
        //migration and model make if find patternName
        $migrationModalCreateStatus=isset($patternName)?$this->makeModalMigrationPattern($patternName):false;
        //modal and migration status message show
        $migrationModalCreateStatus?$this->info("Your Migration And Model Create successfully"):$this->error("Sorry Please Try again");
        //make controller stage





    }



    //migration maker use pattern name

    private function  makeModalMigrationPattern($patternName){
        //check singular and check speech  and replace and check models file directory exist if no exist it's make file with permission
        $ModelFolderPath="/Models";
        $this->makeFolderOrDirectory($ModelFolderPath);
        //check modal is already create or not
        $fileExistOrNot=$this->checkFileAlreadyCreateOrNot($ModelFolderPath,$patternName);
        if($fileExistOrNot){
            Artisan::call('make:model Models/'.str_replace(' ','',Str::singular($patternName )) . ' -m');
            return true;
        }else{
            $this->warn("Your Modal Migration is not create because It's already exist ");
            return false;
        }

    }









    //check FIle exist or not
    public function checkFileAlreadyCreateOrNot($filePath,$fileName){
        $path=app_path($filePath.'/'.$fileName.'.php');
        if(!file_exists($path))
        {
            return true;
        }else{
            return false;
        }
    }




    //folder create or directory create method
    public function makeFolderOrDirectory($FolderPath){
        $path=app_path($FolderPath);
        if(!file_exists( $path))
        {
            File::makeDirectory( $path,$mode=0777,true,true);
        }//end file create option ;
    }
}
