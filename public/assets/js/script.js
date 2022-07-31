window.addEventListener('load', () => {
    console.log("js loaded");
    const pierre = document.getElementById('stone')
    const feuille = document.getElementById('paper')
    const ciseaux = document.getElementById('scissor')

    let score = 0;

    let computerScore = 0;


    displayScore(score,computerScore);

    const choices = document.querySelectorAll('.choices')
    choices.forEach(el => {
        el.addEventListener('click', () => {
            const choicesBox = document.getElementById('player-choice')

            let xhr = new XMLHttpRequest();
            choicesBox.style.display = "none"
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

                }, 1000)
                if (data[1]) {
                    score++;
                    displayScore(score,computerScore);
                }
                if (data[2]){
                    computerScore++;
                    displayScore(score,computerScore);
                }
            }

            xhr.send()
        })
    })

})


const displayScore = (score,computerScore)=>{
    const scoreDisplay = document.getElementById('score')
    scoreDisplay.innerHTML = `YOU : ${score}
    <p class="computer-score">COMPUTER : ${computerScore}</p>`
}