var fs = require('fs');

var myParser = require('body-parser');

var filename = "user_data.json";

//only open file if it exists 
if(fs.existsSync(filename)) {
    var raw_data = fs.readFileSync(filename,'utf-8');
    var users_reg_data = JSON.parse(raw_data);
    console.log(users_reg_data);

    fstats = fs.statSync(filename);
    console.log(filename + ' ' + 'has' + ' ' + fstats.size);
}
else {
    console.log('File' + ' ' + filename + ' ' + 'does not exist');
}

