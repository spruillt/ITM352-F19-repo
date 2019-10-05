var age = 20;
var counter = 1;
// repeat until counter is greater than or equal to square root of age
while(counter != age) {
    if (counter >= Math.sqrt(age)){
        break;
    }
console.log('counter: ' + counter);
counter++
}