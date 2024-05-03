<?php
class PigLatin
{

    /**
     * @var string
     */
    private $pigWord;


    public function translate()
    {

            $text = $_GET['text'];

            $vowels = 'aeiouy';
            $suffix = "ay";
            $phrase=explode(" ", $text); //rozdělení řetězce na jednotlivá slova
    
            foreach($phrase as $word) //proiterování pole slov
            {
                $wordLength = strlen($word); //nalezení délky aktuálního slova
                $pos = strcspn(strtolower($word), $vowels); //nalezení první samohlásky v aktuálním slově
                $firstLetter = substr($word, 0, $pos); //uložení prvního písmene nebo písmen, které nejsou samohlásky
                $punctuation = substr($word, $wordLength - 1, $wordLength); //uložení posledního znaku v řetězci, je potřeba v případě, že tam je interpunkční znaménko
                $last = strcspn(strrev($word), $vowels); //zjištění poslední samohlásky v aktuálním slově

                if($wordLength > 2) //kontrola zda má slovo aspoň 3 písmena, jinak výpis originálního slova
                    {	          
                      if(preg_match("/(\?|\.|\!)$/", $word)) //kontrola, zda je v řetězci interpunkční znaménko
                        {  
                           $word = substr($word,0,$wordLength-1);//pokud existuje interpunkční znaménko, je odtrženo od řetězce
                            if($pos > 0) //pokud první písmeno není samohláska
                            {                                
                               // odtržení souhlásek a přidání na konec, přidání "ay" a interpunkce na konec
                                echo ($this->pigWord =' '. substr($word,$pos) . '-' .$firstLetter . $suffix . $punctuation );
                            }
                            else
                            {
                                //pokud je 1. písmeno samohláska, přidání "ay" a interpunkce na konec
                               if($last>1) 
                                {
                                echo ($this->pigWord = ' '. $word . '-'.$suffix . $punctuation);
                                }
                               else
                                {    //pokud je poslední písmeno samohláska, přidání "way" na konec
                                echo ($this->pigWord = ' '. $word . '-w'.$suffix . $punctuation);}
                                }  	
                        }
                      else
                        {   //pokud v řetězci není interpukční znaménko		
                            if($pos > 0)
                            {
                             echo ($this->pigWord =' '. substr($word,$pos) . '-'.$firstLetter . $suffix);
                            }
                            else
                            {
                               if($last>0)
                                {
                                echo ($this->pigWord = ' '. $word . '-'.$suffix);
                                }
                                else
                                {    //pokud je poslední písmeno samohláska, přidání "way" na konec
                                echo ($this->pigWord = ' '. $word . '-w'.$suffix);
                                }
                            }
                        }	
                    }
                else
                    { //pokud je řetězec kratší než 3 písmena, uložení originálního slova
                     echo $this->pigWord =' '. $word;
                    }        
             
            }

    }    
}
