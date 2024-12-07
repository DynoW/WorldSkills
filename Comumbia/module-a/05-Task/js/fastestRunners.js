/**
 * @typedef {Object} Runner
 * @property {String} name
 * @property {String[]} paces
 * @typedef {Object} Result
 * @property {String} name
 * @property {String} averagePace
 * @property {String} fastestPace
 */

/**
 * @param {Runner[]} runners
 * @return {Result[]}
 */

function fastestRunners(runners) {
	let totalPace = 0;
	for (let runner of runners) {
		let paces = runner.paces.map(pace => {
			const [minutes, seconds] = pace.split(':').map(Number);
			return minutes * 60 + seconds;
		})
		let sum = 0;
		for (let pace of paces) {
			sum += pace;
		}
		runner.fastestPace = Math.min(...paces);
		runner.averagePace = Math.floor(sum / paces.length);
		totalPace += runner.averagePace;
		delete runner.paces
	}
	let averageToatlPace = totalPace / runners.length;
	let newRunners = runners.filter(runner => runner.averagePace < averageToatlPace).sort((a, b) => a.averagePace - b.averagePace).map(runner => ({
			name: runner.name,
			averagePace: `${Math.floor(runner.averagePace / 60)}:${String(runner.averagePace % 60).padStart(2, '0')}`,
			fastestPace: `${Math.floor(runner.fastestPace / 60)}:${String(runner.fastestPace % 60).padStart(2, '0')}`
		}));
	return newRunners;
}

fetch('./js/runners.json')
	.then((response) => response.json())
	.then((json) => {
		let results = fastestRunners(json);
		document.getElementById('fastest').innerHTML = JSON.stringify(results);
	});