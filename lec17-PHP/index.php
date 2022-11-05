<?php 

// Array 
// 1. Index Array 
// 2. Multi Dimension 
// 3. Assoicatice Array

// key => value

// $family = ['Hashim', 'Mohammed', 'Merehan', 'Alaa', 'Shimaa', 'Abood', 'Baraa', 'Ali', 'Seraj', 'Kareem'];
// $family = array();

// $family[1] = 'Zina';
// $family[6] = null;
// unset($family[6]);

// echo '<pre>';
// var_dump($family);
// echo '</pre>';

// echo $family[5];


// $family = [
//     ['Hashim', 'Naji', 'Hamza'], 
//     ['Mohammed', ['Zina', 'Mohammed']], 
//     ['Merehan', 'Adam'], 
//     ['Alaa', 'Fadil', 'Maryam'], 
//     ['Shimaa']
// ];

// echo $family[1][1][1];

// $family[4][] = 'Ali';

// echo $family[1][1];

// unset($family[1][0]);

// var_dump($family);

// $ages = [20, 25, 28, 27, 22, 23, 20, 24, 26, 25];

// =>
// ->
// . 
// ::
// \
// ... 
// ??
// ?:
// ? :
// fn() => 
// __ 


// $ages = [
//     'Mohammed Naji' => 28, 
//     'Ali' => 25, 
//     'Amal' => 28, 
//     'Kazem' => 27, 
//     'Alaa' => 22, 
//     'Mahmoud' => 23, 
//     'Mohammed' => 20, 
//     'Kamel' => 24, 
//     'Baraa' => 26, 
//     'Sawsamn' => 25,
//     // 1000 => 20
// ];

// echo $ages[3];

// $ages[2] = 18;

// var_dump($ages);

// echo $ages['Mohammed'];
// $x = 10;
// var_dump($GLOBALS['x']);
// global $x;


// Super Global Variables
// 1. $GLOBALS
// 2. $_SERVER 
// 3. $_ENV 
// 4. $_GET
// 5. $_POST
// 6. $_REQUEST
// 7. $_FILES
// 8. $_SESSION
// 9. $_COOKIE
// var_dump($_SERVER);

// $foods = [
//     'Ali' => ['food1' => 'Shawerma', 'food2' => 'Kebab'],
//     'Amal' => ['Pizza', 'Salad']
// ];

// echo $foods['Ali']['food1'];

// $family = ['Hashim', 'Mohammed', 'Merehan', 'Alaa', 'Shimaa', 'Abood', 'Baraa', 'Ali'];

// for($i = 0 ; $i <= count($family) - 1 ; $i++) {
//     echo $family[$i] . "<br>";
// }
// init 
// while(condition){ 
//     action 

//     counter
// }

// $i = 0;

// while($i < count($family)) {
//     echo $family[$i] . "While <br>";
//     $i++;
// }

// $i = 0;

// do {
//     echo $family[$i] . " Do -- While <br>";
//     $i++;
// }while($i < count($family));

// Loop 
// 1. for 
// 2. while 
// 3. do .. while 
// 4. foreach

// for(init ; condition ; counter) {
//     actions
// }

// for($i = 0 ; true ; ++$i) {
//     echo $i;
// }
// $family = ['Hashim', 'Mohammed', 'Merehan', 'Alaa', 'Shimaa', 'Abood', 'Baraa', 'Ali', 'Merehan', 'Alaa', 'Shimaa', 'Abood', 'Baraa', 'Ali'];

// foreach($family as $member) {
//     echo "$member<br>";
// }

// echo '<p></p>';

// $ages = [
//     'Mohammed Naji' => 28, 
//     'Ali' => 25, 
//     'Amal' => 28, 
//     'Kazem' => 27, 
//     'Alaa' => 22, 
//     'Mahmoud' => 23, 
//     'Mohammed' => 20, 
//     'Kamel' => 24, 
//     'Baraa' => 26, 
//     'Sawsamn' => 25,
// ];

// $keys = array_keys($ages);
// // $values = array_values($ages);

// for($i=0 ; $i < count($keys) ; $i++) {
//     // echo $keys[$i] .' - ';
//     echo  "Welcome ". $keys[$i]. ", Your age is {$ages[$keys[$i]]} <br>";
// }

// var_dump($keys);

// foreach($ages as $name => $age) {
//     echo "Welcome $name, your age is $age <br>";
// }

// $x = 10; // 11 // 10
// $y = 5; // 4 // 3

// echo $y * 2 + ++$x + $y-- + $y-- + $x - --$x;
// echo $x;
// echo $y;
// echo $x++ + $y++ - $x++ + ++$y * 2;
// echo $x;
// echo $y;
    //  10   + 5    - 11  +  7  * 2
    //  10 + 5 - 11 + 14
    //  18
    // $x = 5; // 4 // 3
    // $y = 6; // 5
    // $z = 2; // 1 // 0
    // echo --$x - --$y - --$z * (5 * $x) * (--$x * --$z);
    //     //  4    - 5    -   1  * (5 * 4 ) * ( 3   * 0) 
    // echo $x;
    // echo $y;
    // echo $z;

