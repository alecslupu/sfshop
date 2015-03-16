All developers working on the sfShop platform should follow next Coding standards.

## 1. PHP File Formatting ##
#### 1.1. General ####
For files that contain only PHP code, the closing tag ("?>") is never permitted. It is not required by PHP. Not including it prevents trailing whitespace from being accidentally injected into the output.

#### 1.2. Indentation ####
Use an indent of 2 spaces, with no tabs.

#### 1.3. Maximum Line Length ####
The target line length is 80 characters, i.e. developers should aim keep code as close to the 80-column boundary as is practical. However, longer lines are acceptable. The maximum length of any line of PHP code is 120 characters.

#### 1.4. Line Termination ####
Line termination is the standard way for Unix text files. Lines must end only with a linefeed (LF).

## 2. Naming Conventions ##
#### 2.1. Classes ####
Class names may only contain alphanumeric characters. Underscores are not permitted.
Class names must always start with sfs prefix which points that class is a part of sfShop platform.  When a class name consists of more than one word, the first letter of each new word must be capitalized. This is commonly called "camelCase" formatting.

#### 2.2. Interfaces ####
Interface classes must follow the same conventions as other classes (see above), however must end with the word "Interface".

#### 2.3. Filenames ####
For all other files, only alphanumeric characters, underscores are permitted. Spaces are are not permitted. Any file that contains any PHP code must end with the extension ".php". If file contains class, file should have sufix ".class" before extension ".php".
```
sfsAccess.class.php //for class
sfsAccess.php //for function 
```
#### 2.4. Functions and Methods ####
Function names may only contain alphanumeric characters. Underscores are not permitted. Function names must always start with a lowercase letter. When a function name consists of more than one word, the first letter of each new word must be capitalized.
```
filterInput()
getElementById()
widgetFactory()
```
#### 2.5. Variables ####
Variable names may only contain alphanumeric characters. Underscores are not permitted. Numbers are permitted in variable names but are discouraged. For class member variables that are declared with the "private" or "protected" construct, the first character of the variable name must be a single underscore. This is the only acceptable usage of an underscore in a variable name. Member variables declared "public" may never start with an underscore.
Like function names (see section 3.3, above) variable names must always start with a lowercase letter and follow the "camelCaps" capitalization convention.

#### 2.6. Constants ####
Constants may contain both alphanumeric characters and the underscore. Numbers are permitted in constant names. Constants must always have all letters capitalized. To enhance readablity, words in constant names must be separated by underscore characters.
```
EMBED_SUPPRESS_EMBED_EXCEPTION // is permitted  
EMBED_SUPPRESSEMBEDEXCEPTION // is not. 
```

## 3. Coding Style ##
#### 3.1. PHP Code Demarcation ####
PHP code must always be delimited by the full-form, standard PHP tags:
```
<?php
?>
```
Short tags are never allowed.

#### 3.2. Arrays ####
#### 3.3.1. Numerically Indexed Arrays ####
Negative numbers are not permitted as indices.
An indexed array may be started with any non-negative number, all arrays have a base index of 0.
When declaring indexed arrays with the array construct, a trailing space must be added after each comma delimiter to improve readability.
```
$sampleArray = array(1, 2, 3, 'Zend', 'Studio');
```
It is also permitted to declare multiline indexed arrays using the "array" construct. In this case, each successive line must be padded with spaces such that beginning of each line aligns as shown below.
```
$sampleArray = array(
    1, 2, 3, 'Zend', 'Studio',
    $a, $b, $c,
    56.44, $d, 500
);
```
#### 3.3.2. Associative Arrays ####
When declaring associative arrays with the array construct, it is encouraged to break the statement into multiple lines. In this case, each successive line must be padded with whitespace such that both the keys and the values are aligned:
```
$sampleArray = array(
    'firstKey'  => 'firstValue',
    'secondKey' => 'secondValue'
);
```
#### 3.4. Classes ####
#### 3.4.1. Class Declaration ####
Classes must be named by following the naming conventions.
The brace is always written on the line underneath the class name ("one true brace" form).
Every class must have a documentation block that conforms to the PHPDocumentor standard.
Any code within a class must be indented four spaces.
Only one class is permitted per PHP file.
Placing additional code in a class file is permitted but discouraged. In these files, two blank lines must separate the class from any additional PHP code in the file.
This is an example of an acceptable class declaration:
```
/**
* Documentation Block Here
*/
class sfsSampleClass
{
  //entire content of class
  //must be indented four spaces
}
```
#### 3.4.2. Class Member Variables ####
Member variables must be named by following the variable naming conventions.
Any variables declared in a class must be listed at the top of the class, prior to declaring any methods.
The var construct is not permitted. Member variables always declare their visibility by using one of the private, protected, or public constructs. Accessing member variables directly by making them public is permitted but discouraged in favor of accessor methods (set/get).

#### 3.5. Functions and Methods ####
#### 3.5.1. Function and Method Declaration ####
Functions must be named by following the naming conventions. Methods inside classes must always declare their visibility by using one of the private, protected, or public constructs.
Like classes, the brace is always written on the line underneath the function name ("one true brace" form). There is no space between the function name and the opening parenthesis for the arguments.
Functions in the global scope are strongly discouraged.

```
/**
* Documentation Block Here
*/
class Foo
{
    /**
    * Documentation Block Here
    */
    public function bar()
    {
        //entirecontent of function
        // must be indented four spaces
    }
}
```

#### 3.5.2. Function and Method Usage ####
Function arguments are separated by a single trailing space after the comma delimiter.
```
threeArguments(1, 2, 3);
```
For functions whose arguments permit arrays, the function call may include the "array" construct and can be split into multiple lines to improve readability.
```
threeArguments(array(1, 2, 3), 2, 3);
threeArguments(
    array(1, 2, 3, 'Zend', 'Studio'),
    $a,
    $b
);
```
#### 3.6. Control Statements ####
#### 3.6.1. If / Else / Elseif ####
Control statements based on the if and elseif constructs must have a single space before the opening parenthesis of the conditional, and a single space after the closing parenthesis.
Within the conditional statements between the parentheses, operators must be separated by spaces for readability. Inner parentheses are encouraged to improve logical grouping of larger conditionals.
The opening brace is written on the same line as the conditional statement. The closing brace is always written on its own line.
```
if ($a != 2) {
    $a = 2;
}
```
For "if" statements that include "elseif" or "else", the formatting conventions are as shown in the following examples:
```
if ($a != 2) {
   $a = 2;
}
else {
   $a = 7;
}
if ($a != 2) {
  $a =2;
}
elseif ($a == 3) {
   $a = 4;
}
else {
   $a = 7;
}
```
#### 3.6.2. Switch ####
Control statements written with the "switch" construct must have a single space before the opening parenthesis of the conditional statement, and also a single space after the closing parenthesis.
All content within the "switch" statement must be indented four spaces. Content under each "case" statement must be indented an additional four spaces.
```
switch ($numPeople) {
    case 1:
        break;
    case 2:
        break;
     default:
        break;
}
```
The construct default may never be omitted from a switch statement.