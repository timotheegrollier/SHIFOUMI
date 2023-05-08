window.addEventListener('load', () => {
    console.log("js loaded");
    const pierre = document.getElementById('stone')
    const feuille = document.getElementById('paper')
    const ciseaux = document.getElementById('scissor')
    const resetBest = document.getElementById('resetBest');
    const gameFooter = document.getElementById('game-footer');
    let bestScore = parseInt(document.getElementById('best-score-score').innerHTML);
    let equalityMsg = document.getElementById('equality-msg')



    let score = 0;

    let computerScore = 0;

    resetBest.addEventListener('click', (e) => {
        resetBestScore(e);
        score = 0;
        computerScore = 0
        displayScore(score,computerScore)
    })

    displayScore(score, computerScore);

    const choices = document.querySelectorAll('.choices')
    choices.forEach(el => {
        el.addEventListener('click', () => {
            const choicesBox = document.getElementById('player-choice')

            let xhr = new XMLHttpRequest();
            choicesBox.style.display = "none"
            gameFooter.style.display = "none"
            xhr.open('GET', '?action=' + el.id)

            xhr.onload = () => {
                let data = JSON.parse(xhr.responseText)
                console.log(data);
                let computerStone = document.getElementById('computer-stone')
                let computerPaper = document.getElementById('computer-paper')
                let computerScissor = document.getElementById('computer-scissor')
                if (data[0] === "STONE")
                    computerStone.style.display = "block"
                setTimeout(() => {
                    computerStone.style.display = "none"
                }, 1000)
                if (data[0] === "PAPER")
                    computerPaper.style.display = "block"
                setTimeout(() => {
                    computerPaper.style.display = "none"
                }, 1000)
                if (data[0] === "SCISSOR")
                    computerScissor.style.display = "block"
                setTimeout(() => {
                    computerScissor.style.display = "none"
                    choicesBox.style.display = "flex"
                    gameFooter.style.display = "flex"
                }, 1000)
                if (data[1]) {
                    score++;
                    displayScore(score, computerScore);
                    if (score > bestScore) {
                        setBestScore(score, bestScore).then(
                            document.getElementById('best-score-score').innerHTML = score
                        )
                    }
                }
                if (data[2]) {
                    computerScore++;
                    displayScore(score, computerScore);
                }

                if(data[3]){
                    let equalityInterval = setInterval(()=>{
                        equalityMsg.style.display = "flex"
                        setTimeout(()=>{
                            equalityMsg.style.display = "none"
                        },200)
                        clearInterval(equalityInterval)
                    },1000)
                }
            }

            xhr.send()
        })
    })





})

const setBestScore = async (score, bestScore) => {
    console.log('New best !');
    let xhr = new XMLHttpRequest();

    xhr.open('POST', '/')

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    await xhr.send('score=' + score + '&bestScore=' + bestScore)

}

const displayScore = (score, computerScore) => {
    const scoreDisplay = document.getElementById('score')
    scoreDisplay.innerHTML = `YOU : ${score}
    <p class="computer-score">COMPUTER : ${computerScore}</p>`
}


const resetBestScore = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '/')


    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    document.getElementById('best-score-score').innerHTML = 0



    xhr.send('delete=bestScore')
}