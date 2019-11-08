/*
Purpose: Function to determine if string is non negative integer 
Date: 10/18/19
Author: Tyler Spruill 

Revision History:
Usage Notes:
*/

function isNonNegInt(q)
{
    errors = []; // assume no errors at first
    if(Number(q) != q) enrrors.push('Not a number!'); // Check if string is a number value
    if(q < 0) errors.push('Negative value!'); // Check if it is non-negative
    if(parseInt(q) != q) errors.push('ok stupid'); // Check that it is an integer 

    return(errors.length == 0);
}

console.log(isNonNegInt("5"));