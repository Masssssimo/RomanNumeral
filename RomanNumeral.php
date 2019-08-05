<?php
namespace PhpNwSykes;

class RomanNumeral
{
    protected $symbols = [
        1000 => 'M',
        500 => 'D',
        100 => 'C',
        50 => 'L',
        10 => 'X',
        5 => 'V',
        1 => 'I',
    ];

    protected $numeral;

    public function __construct(string $romanNumeral)
    {
        $this->numeral = $romanNumeral;
    }

    /**
     * Converts a roman numeral such as 'X' to a number, 10
     *
     * @throws InvalidNumeral on failure (when a numeral is invalid)
     */

    public function toInt():int
    {		
	//The time complexity is approximately O(n^2)
	
        //Make char array of the Roman numeral
        $arr = str_split($this->numeral);
        //Get symbols keys and values
        $symbols = $this->symbols;
        //Initialise result
        $total = 0;
        //Initialise iterator
        $i = 0;
        while($i<count($arr)){
          //Check if the token is a vaild Roman numeral
          if (in_array($arr[$i], $symbols)){
            //Check if the current index is not the last position
            if($i+1<count($arr)){
              //Compare the two index positions
              $currIndex = array_search($arr[$i], $symbols);
              $nextIndex = array_search($arr[$i+1], $symbols);
              /**
              * If the current index is smaller than the next index
              * then subtract the current index from the next index
              * then add it to the total
              */
              if($currIndex<$nextIndex){
                $total += $nextIndex - $currIndex;
                //Increment twice and continue
                $i+=2;
                continue;
              }
            }
            //Add the current index to the total
            $currIndex = array_search($arr[$i], $symbols);
            $total += $currIndex;
            $i++;
          }else {
            //Invaild numeral
            throw new \Exception("Invalid Token", 1);
          }
        }
        return $total;
    }

}
