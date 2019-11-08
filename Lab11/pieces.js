/*
Purpose: Function to determine if string is non negative integer 
Date: 10/18/19
Author: Tyler Spruill 

Revision History:
Usage Notes:
*/

function isNonNegInt(q, sendArrayBack = false)
{
    errors = []; // assume no errors at first
    if(Number(q) != q) enrrors.push('Not a number!'); // Check if string is a number value
    if(q < 0) errors.push('Negative value!'); // Check if it is non-negative
    if(parseInt(q) != q) errors.push('Not an integer!'); // Check that it is an integer 

    if(sendArrayBack)
    {
        return(errors);
    }
    else
        {
            return(errors.length == 0);
        }
}


console.log(isNonNegInt("-3",true));

attributes = "Tyler;20;20.5;19.5" ;
separator = ";";
pieces = attributes.split(separator);
console.log(pieces); 
console.log("Hi Marisa!");
for(i=0; i<pieces.length; i++) {
    console.log($(typeof(pieces[i])} $(pieces[i])} $(isNonNegInt()});
  
}

recon = pieces.join(separator);
console.log(recon); 
