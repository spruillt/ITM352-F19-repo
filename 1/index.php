<!--
Author: Wade Yoshida 

Purpose: This index page pays homage to a television show called "Rick and Morty".  The e-store is named after a store created by Rick to remove curses from 
items sold by the devil.  The items sold in the e-store are inspired by items in the Rick and Morty universe that never quite seem to make any sense.

This file will display products available for sale and allow a user to input how many of each item they'd like to buy.  After valid quantities are entered, 
the page will issue an invoice that calculates the total cost of all items ordered.
-->
<?php
///Product Data
$item1 = array(
    'image' => 'plumbus.jpg',
    'description' => 'Made from the highest quality dinglebop, our Plumbi are smoothed to perfection using renewable shleem and have a very green gazorpian foot print.  We only use grade AAA+ fleeb juice on our fleebs to ensure your plumbus will last a longer than the shalomian who made it.',
    'price' => 1.01);
$item2 = array(
    'image' => 'meeseeks.jpg',
    'description' => 'Got a problem? Meeseeks to the rescue!  Order a Meeseeks box today and summon an infinite amount of Meeseeks to help you solve any and all problems!  Please remember, existence is pain.',
    'price' => 999.99);
$item3 = array(
    'image' => 'gazorpazorpfield.jpg',
    'description' => 'Hate Mamomadunsdays?  Love enchiladas?  We have the pet just for you!  Order now. Please.',
    'price' => 00.01);
$item4 = array(
    'image' => 'fleeb.jpg',
    'description' => 'High quality martian fleeb. <br> *Fleeb juice not included.',
    'price' => 19.99);
$item5 = array(
    'image' => '/portalgun.jpg',
    'description' => 'Travel to different dimensions with your very own portal gun!',
    'price' => 74.25);

$allProducts = array($item1, $item2, $item3, $item4, $item5);


if (!array_key_exists('quantity', $_POST)) : //displays product page if no values have been entered in the quantity boxes

    display_products($allProducts);

else :
    //check that valid quantities were selected, otherwise redisplay product page
    $errors = array();
    validate_quantities($_POST['quantity']);

    if (empty($errors)) { //checks if any errors are saved in the array
        process_invoice($allProducts, $_POST['quantity']); // creates invoice if no errors
    } else {
        display_products($allProducts); // redisplay products page if errors are present
    }
endif; 

function validate_quantities($the_quantities) { // function to check all boxes for errors
    global $errors; //allows $errors to be accessed across functions
    foreach ($the_quantities as $index => $quantity) { // checks each $quantity in array $the_quantities
        //identifies any negative numbers
        if ($quantity < 0) 
            @$errors['quantity'][$index] .= '<br>Can\'t order in the negative broh';
        //identifies any non-whole numbers
        if ($quantity != (int)$quantity)
            @$errors['quantity'][$index] .= '<br>Gotta be an integer broh';
        //identifies letters while allowing blank submissions 
        if (!empty($quantity) && !is_numeric($quantity)) 
            @$errors['quantity'][$index] .= '<br>Put a number broh';
        //identifies if invoice is empty
        if (array_sum($the_quantities) == 0) 
            @$errors['no_quantity'] = '<br>You gotta buy something broh';
    }
}

function display_products($list_of_items, $quantities = array()) { //products page
    global $errors; //allows $errors to be accessed across functions
    ?>

    <html>
        <head>
            <title>Curse Purge Plus</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <link rel="stylesheet" href='style.css'>
        <link href='https://fonts.googleapis.com/css?family=Pacifico|Quicksand' rel='stylesheet' type='text/css'>
        <body>
        <center>
            <h1>Welcome to Curse Purge Plus!</h1>
            <h2>Wubba lubba dub-dub!</h2>
            <form action="<?php echo $_SERVER ['PHP_SELF']; ?>" method="post"> <!-- form allows page to process inputs-->
                <table border="1"> <!-- Creates table -->
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><b><big>Product</big></b></td>
                            <td style="text-align: center;"><b><big>Description</big></b></td>
                            <td style="text-align: center;"><b><big>Price</big></b></td>
                            <td style="text-align: center;"><b><big>Quantity Desired</big></b></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($list_of_items); $i++) {
                            //runs for loop once for each product in array
                            if (empty($quantities)) { //checks if any values in $quantities array
                                //quantity in box stays current value, if empty default to 0
                                $value = isset($_POST['quantity'][$i]) ? $_POST['quantity'][$i] : 0; // makes sticky
                                //saves box input in $quantity[$i] array
                                $qty_str = "<input type=text size=3 maxlength=3 name=quantity[$i] value=$value>";
                                // check if there are errors saved
                                if (isset($errors['quantity'][$i])) {
                                    //displays errors under box in red letters
                                    $qty_str .= "<div style='color:red'>{$errors['quantity'][$i]}</div>";
                                }
                                //purchase button
                                $submit_str = '<input type="submit" value="Purchase">';
                            } else {
                                //replaces boxes with value input
                                $qty_str = $quantities[$i];
                                $submit_str = '';
                            }

                            //generates product table and fills in the cells (Taken from SmartPhoneProducts 6)
                            printf('
                <tr>
                    <td><img alt="Small" id="lightboxImage"
                             style="width: 119px; height: 119px;"
                             src="./images/%s"
                             height="300" width="300"></td>
                    <td style="text-align: center;">%s</td>
                    <td style="text-align: center;">$%.2f</td>
                    <td style="text-align: center;">%s</td>
                   
                    
                </tr>', $list_of_items[$i]['image'], $list_of_items[$i]['description'], $list_of_items[$i]['price'], $qty_str);
                        }
                        ?>

                    </tbody>
                </table>
                <?php 
                //returns error at bottom of page if no values entered
                if (isset($errors['no_quantity'])) {
                    echo "<br><div style='font:22px/42px Arial,tahoma,sansserif;color:red'>{$errors['no_quantity']}</div>";
                }
                    
                //displays purchase button    
                echo $submit_str; ?>
                
                <!-- Displays shipping policy at bottom of page (Taken from Invoice 6) -->
                   <p width="200px"><b>SHIPPING POLICY:<br>
                A subtotal $0 - $49.99 will be $2 shipping<br>
                A subtotal $50 - $99.99 will be $5 shipping<br>
                Subtotals over $100 will be charged 5% of the subtotal amount </b></p>
            </form>
        </center>
    </body>
    </html>
    <?php
}


function process_invoice($list_of_items, $quantities = array()) { //function for displaying and calculating invoice
    global $errors; //allows $errors to be accessed between functions
    ?>

    <html>
        <head>
            <title>Curse Purge Plus</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <link rel="stylesheet" href='style.css'>
        <link href='https://fonts.googleapis.com/css?family=Pacifico|Quicksand' rel='stylesheet' type='text/css'>
        <body>
        <center>
            <h1>Thanks for Ordering from Curse Purge Plus!</h1>
            <h2>Wubba lubba dub-dub!</h2>
            <table border="1"> <!-- creates table with extra extended price column -->
                <tbody>
                    <tr>
                        <td style="text-align: center;"><b><big>Product</big></b></td>
                        <td style="text-align: center;"><b><big>Description</big></b></td>
                        <td style="text-align: center;"><b><big>Price</big></b></td>
                        <td style="text-align: center;"><b><big>Quantity Desired</big></b></td>
                        <td style="text-align: center;"><b><big>Extended Price</big></b></td>
                    </tr>
                    <?php
                    $subtotal = 0; //defines $subtotal 
                    //calculates $subtotal by calculating extended prices of each item one at a time and adding them together
                    for ($i = 0; $i < count($list_of_items); $i++) {
                        //only calculates extended price for products that are ordered
                        if ($quantities[$i] > 0) {
                            //text boxes replaced with values input and removes preceeding 0's
                            $qty_str = abs($quantities[$i]);
                            //calculate extended price of item [$i]
                            $extendedprice[$i] = $list_of_items[$i]['price'] * $quantities[$i];
                            //calculate subtotal by cumulatively adding extended prices
                            $subtotal = $subtotal + $extendedprice[$i];

                            //generates new table of products that were ordered (Taken from SmartPhoneProducts 6)
                            printf('
                <tr> 
                    <td><img alt="Small" id="lightboxImage"
                             style="width: 119px; height: 119px;"
                             src="./images/%s"
                             height="300" width="300"></td>
                    <td style="text-align: center;">%s</td>
                    <td style="text-align: center;">$%.2f</td>
                    <td style="text-align: center;">%s</td>
                    <td style="text-align: center;">$%.2f</td>
                   
                    
                </tr>', $list_of_items[$i]['image'], $list_of_items[$i]['description'], $list_of_items[$i]['price'], $qty_str, $extendedprice[$i]);
                        }
                    }
                    //end of for loop
                    
                    
                    $tax_rate = 0.0575;
                    //calculate tax @ 5.75%
                    $tax = $tax_rate * $subtotal;

                    //define $shipping
                    $shipping = 0;

                    //calculate shipping price based on cost of items
                    if ($subtotal == 0) {
                        //no items no shipping
                        $shipping = 0;
                    } elseif ($subtotal > 0 & $subtotal < 50) {
                        //orders between $0-$50 charged $2 shipping
                        $shipping = 2;
                    } elseif ($subtotal >= 50 & $subtotal < 100) {
                        //orders between $50-$100 charged $5 shipping
                        $shipping = 5;
                    } else {
                        //orders over $100 charged 5% of subtotal for shipping
                        $shipping = $subtotal * 0.05;
                    }


                    //calculate total cost
                    $total = $subtotal + $tax + $shipping;
                    ?>
                    
                    <!-- generate table for invoice at bottom of page (Taken from Invoice 6) -->
                    <!--$subtotal row -->
                    <tr>
                        <td colspan="3" width="67%">
                            Sub-total
                        </td>
                        <td style="text-align: center;" width="54%">
                            $
                            <?php
                            //subtotal
                            printf('%.2f', $subtotal);
                            ?>

                        </td>
                    </tr>
                    <!--$tax row -->
                    <tr>
                        <td colspan="3" width="67%">

                            <font face="arial">
                            Tax @ 5.75%
                            </font>
                        </td>
                        <td style="text-align: center;" width="54%">
                            $ <?php printf('%.2f', $tax); ?>
                        </td>
                    </tr>
                    <!--$shipping row -->
                    <tr>
                        <td colspan="3" width="67%">

                            <font face="arial">
                            Shipping
                            </font>
                        </td>
                        <td style="text-align: center;" width="54%">
                            $ <?php
                            printf('%.2f', $shipping)
                            ?>
                        </td>  
                    </tr>
                    <!--$total row -->
                    <tr>
                        <td colspan="3" width="67%">
                            <b>
                                Total
                            </b>
                        </td>
                        <td style="text-align: center;" width="54%">
                            <b>
                                $ <?php printf('%.2f', $total); ?>
                            </b>
                        </td>
                    </tr>
                </tbody>
            </table>
    </center>
    </body>
    </html>
    <?php
}
?>
