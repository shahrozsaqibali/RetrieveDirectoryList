<?php

$valid_extentions_background = array("jpg","jpeg");
$valid_extentions_collage = array("png");

$background_dir = 'collage_background';
$collage_dir = 'collage_pattern';


$background_list;
$collage_list;
$collage_count;
$background_count;

if(file_exists($background_dir) && file_exists($collage_dir))
{
     $background_list = scandir($background_dir,1);
     $collage_list = scandir($collage_dir,1);

     $collage_count = count($collage_list);
     $background_count = count($background_list);


     //Removing "." , ".." value from Array and Validating Extension of the file.
     for ($i = 0; $i < $background_count ; $i++)
     {
         if($background_list[$i] == "." || $background_list[$i] == "..")
         {
             unset($background_list[$i]);
         } 
         else
         {
            $extension = $dir = substr(strrchr($background_list[$i], "."), 1);
            if(in_array($extension,$valid_extentions_background))
            {
                  //DO NOTHING
            }
            else
            {
                unset($background_list[$i]);
            }
         }
     }

     for ($i = 0; $i < $collage_count ; $i++)
     {
         if($collage_list[$i] == "." || $collage_list[$i] == "..")
         {
             unset($collage_list[$i]);
         }
         else
         {
            $extension = $dir = substr(strrchr($collage_list[$i], "."), 1);
            if(in_array($extension,$valid_extentions_collage))
            {
                 //DO NOTHING
            }
            else
            {
                unset($collage_list[$i]);
            }
         }
    }

    //Converting into Json
    $data['collage_count'] = count($collage_list);
    $data['backgorund_count'] = count($background_list);
    $data['file_array'] = array_merge($background_list,$collage_list);
    echo  json_encode($data);
}
else
{   
    $data['Error'] = "Directory Does not exist.";
    echo json_encode($data);
}
?>