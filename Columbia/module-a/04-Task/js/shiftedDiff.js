/**
 * Write a function that receives two strings and returns the number of characters we would need to rotate the first string forward to match the second.
 *
 * @param {String} first
 * @param {String} second
 * @return {Number}
 */

function shiftedDiff(first, second) {
	first.split("");
	second.split("");
	nr = 0;
	while(first!=second) {
		first[0]=first[first.length]
		first = first[first.length - 1] + first.slice(0, -1);
		nr++;
		if (nr > first.length) return -1;
	}
	return nr;
}

string1 = document.getElementById("string1").value;
string2 = document.getElementById("string2").value;
message = document.getElementById("message").innerHTML;
document.getElementById("calc").addEventListener("click", function() {
	message = shiftedDiff(string1, string2);
});