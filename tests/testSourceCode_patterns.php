<?php
require_once 'main.config.local.php' ;

require_once '../SourceCode.php' ;
require_once '../CSV.php' ;
define('OUTPUT_DIR','data/generated/sourceCodePatterns') ;
define('RULES_FILE','data/input/FileSystemPattern.csv') ;
if (!is_dir(addToPath(ABSPATH_BASE,'101results'))) {
  $dir101results = addToPath(ABSPATH_BASE,'../../101results') ;
  $realBaseDir = addToPath(ABSPATH_BASE,'../..') ;
} else {
  $dir101results = addToPath(ABSPATH_BASE,'101results') ;
  $realBaseDir = ABSPATH_BASE ;
}
$exploreDir = addToPath($dir101results,'101repo/contributions') ;  // /gwtTree

echo '<h2>Exploring and matching the directory '.$exploreDir.'</h2>' ;
$matcher = new FileSystemPatternMatcher(RULES_FILE) ;
$matchedFilesGrouping=array(
    'languages' => 
       array(
           'select' => array('locator','geshiLanguage'),
           'groupedBy' => 'language' 
        ),
     'technologies' =>
       array(
           'select' => array('role'),
           'groupedBy' => 'technology'
       )
 ) ;
$r = $matcher->generate($exploreDir,OUTPUT_DIR,$matchedFilesGrouping,array('language','technology')) ;
echo 'files generated are in <a href="'.OUTPUT_DIR.'" target="_blank">'.OUTPUT_DIR.'</a>' ;
