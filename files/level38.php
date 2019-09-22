<?php
class MorseCodeTranslator {
  private static $library = array(
    '01'    => 'A',
    '1000'  => 'B',
    '1010'  => 'C',
    '100'   => 'D',
    '0'     => 'E',
    '0010'  => 'F',
    '110'   => 'G',
    '0000'  => 'H',
    '00'    => 'I',
    '0111'  => 'J',
    '101'   => 'K',
    '0100'  => 'L',
    '11'    => 'M',
    '10'    => 'N',
    '111'   => 'O',
    '0110'  => 'P',
    '1101'  => 'Q',
    '010'   => 'R',
    '000'   => 'S',
    '1'     => 'T',
    '001'   => 'U',
    '0001'  => 'V',
    '011'   => 'W',
    '1001'  => 'X',
    '1011'  => 'Y',
    '1100'  => 'Z',
    '01111' => '1',
    '00111' => '2',
    '00011' => '3',
    '00001' => '4',
    '00000' => '5',
    '10000' => '6',
    '11000' => '7',
    '11100' => '8',
    '11110' => '9',
    '11111' => '0',
  );
    public function MorseCodeTranslator() {}
        public function morseToLatin($morseString) {
            $chars = explode(' ', $morseString);
            $latinString = '';
            foreach ($chars as $char) {
              if (isset(static::$library[$char])) {
                $latinString .= static::$library[$char];
              }
            }
            return $latinString;
        }
        public function latinToMorse($latinString) {
            $latinString = "Y5BZN5hfsteJHx3z4ES5w3WGY3IAEn954bhznu5gVakxwKKWg9Hy44oV";
            $chars = str_split(strtoupper($latinString));
            $latinToMorseLib = array_flip(static::$library);
            $morseString = '';
            foreach ($chars as $char) {
              if (isset($latinToMorseLib[$char])) {
                $morseString .= $latinToMorseLib[$char];
              }
              $morseString .= ' ';
            }
            $morseString = explode(" ",$morseString);
            for ($i = 0; $i < count($morseString); $i++) {
               echo "<span style='border:1px dashed black;font-size:30px;margin-right:6px'>".$morseString[$i]."</span>";  
             } 
    }

}
$morse = new MorseCodeTranslator;
$morse->latinToMorse();
?>
