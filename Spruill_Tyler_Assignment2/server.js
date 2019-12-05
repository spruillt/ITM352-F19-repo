//server that functions via Express, based on previous labs and in class workshop
var fs = require('fs');
var express = require('express');
var app = express();
var myParser = require('body-parser');
var qs = require('querystring');


//function tests if input is a non-negative integer 
function isNonNegInt(q, returnErrors = false)
{
    errors = []; // assume no errors at first
    if(Number(q) != q) errors.push('Not a number!'); // Check if string is a number value
    if(q < 0) errors.push('Negative value!'); // Check if it is non-negative
    if(parseInt(q) != q) errors.push('Not an integer!'); // Check that it is an integer
    return returnErrors ? errors : (errors.length == 0); 
    
}

function process_quantity_form (POST, response) {
    // take first product in array and get model, assign value, get the price
    let model = products_array[i]['model'];
    let model_price = products_array[i]['price'];

    // check quantity entered
   if (typeof POST['quantity_textbox'] != 'undefined') 
   {
       q = POST ['quantity_textbox']; 
           if (isNonNegInt(q))
           {
            var contents = fs.readFileSync('./views/display_quantity_template.view', 'utf8'); //edit later, quantity template not used for assignment1
            response.send(eval('`' + contents + '`')); // render template string
           }
           else {
               response.send(`${q} is not a quantity! Press the back button and try again.`)
           }
   }
}

// initialize express
app.all('*', function (request, response, next) {
    console.log(request.method + ' to ' + request.path);
    next(); //requests the data from server 
});

app.use(myParser.urlencoded({ extended: true }));

var filename = "user_data.json";

// Only open the file if it exist
if (fs.existsSync(filename)) {
    var raw_data = fs.readFileSync(filename, 'utf-8');
    var users_reg_data = JSON.parse(raw_data);
    //console.log(users_reg_data);

}

else {
    console.log('File ' + filename + " doesnt exist!");
}

app.get("/login", function (request, response) {
// Give a simple login form

    str = `
    <body>
    <form action="" method="POST">
    <input type="text" name="username" size="40" placeholder="enter username" ><br />
    <input type="password" name="password" size="40" placeholder="enter password"><br />
    <input type="submit" value="Submit" name="submit">
    </form>
    </body>
    `;
response.send(str);
});

app.get("/register", function (request, response) {
// Give a simple register form

    str = `
    <body>
    <form action="" method="POST">
    <input type="text" name="username" size="40" placeholder="enter username" ><br />
    <input type="password" name="password" size="40" placeholder="enter password"><br />
    <input type="password" name="repeat_password" size="40" placeholder="enter password again"><br />
    <input type="email" name="email" size="40" placeholder="enter email"><br />
    <input type="submit" value="Submit" id="submit">
    </form>
    </body>
    `;
response.send(str);
});

var user_product_quantities = {};

app.get("/purchase", function(request, response) {
// get quantity data from query string
    user_product_quantities = request.query;
    console.log(user_product_quantities);
    // validate the quantities; if not valid go back to purchase page

// if valid go to login
response.redirect('login');
} );

app.post("/register", function (request, response) {
    let POST = request.body;
    console.log("Got registration request");
    // process a simple register form

    username = POST.username;
    users_reg_data[username] = {};
    users_reg_data[username].name = username;
    users_reg_data[username].password = POST.password;
    users_reg_data[username].email = POST.email;

    output_data = JSON.stringify(users_reg_data);
    fs.writeFileSync(filename, output_data, 'utf-8');
    response.send ("Added user " + username);
});

app.post("/login", function (request, response) {
    let POST = request.body;
    // User submitted a userid and password. Test them for validity.

if (users_reg_data[POST.username] != undefined) { 
    if (POST.password == users_reg_data[POST.username].password) {
        theQueryString = qs.stringify(user_product_quantities);
        response.redirect("/invoice.html?" + theQueryString);
}
    else {
        response.redirect('login');
    }
}
    else {
        console.log ("User " + POST.username + " not found");
        response.redirect('login');
    }
});

app.use(express.static('.'));
app.listen(8080, () => console.log(`listening on port 8080`));