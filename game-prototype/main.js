import "./style.css"

class GameWithFeedback {
  /** ------------ init ------------ **/
   constructor(game) {
    // save the dom nodes that we'll use
    this.cacheNodes(game)

    // bind dom events
    this.attachEventListeners()
  }
  
  
  /** ------------ eval ------------ **/
  
    // overwrite this method for more 
  // complex game logic
    isAnswerComplete() {
      // is question empty of buttons?
      return this.question.children.length === 0
    }
  
  
  // evaluate the game state and show the 
  // appropriate feedback
    // generic mathod, probably not overwritten
    evaluateAnswer() {
      // if answer is not complete hide all prompts
      if (!this.isAnswerComplete()) {
        // no - game in progress
        this.hideFeedback() 
        return false
      }
      // yes - game complete
      
      // is the solution correct ?
      if (this.isGameWon()) {
        // yes - well done !
        this.showSuccess()
        return false
      }
      // no - show the tip
      this.showTip()
    }
  
  
  /** ------------ feedback ------------ **/
  // show the tip text
  showTip() {
    // never show the tip and success at once
    this.hideSuccess()
    this.game.classList.add("game--show-tip")
  }
  
  // hide the tip text
  hideTip() {
    this.game.classList.remove("game--show-tip")
  }

  // show the success text
  showSuccess() {
    // never show the tip and success at once
    this.hideTip()
    this.game.classList.add("game--show-success")
  }
  
  // hide the success text
  hideSuccess() {
    this.game.classList.remove("game--show-success")
  }

  // hide all feedback text
  hideFeedback() {
    this.hideTip()
    this.hideSuccess()
  }
}


/******************************
       Order the words 
*******************************/
class OrderTheWords extends GameWithFeedback {
  constructor(game) {
    // call the constructor of the parent class (required)
    super(game)

  }
  
  /** ------------ init ------------ **/
  // save dom nodes to the class instance
  // for easy access and autocomplete
  cacheNodes(game) {
    this.game = game
    this.tip = game.querySelector(".tip")
    this.success = game.querySelector(".success")
    this.buttons = game.querySelectorAll(".question button")
    this.answers = game.querySelector(".answers")
    this.question = game.querySelector(".question")
    this.reset = game.querySelector(".reset")
  }

  // attach listeners to the dom
  attachEventListeners() {
    
    // move a button when clicked
  this.buttons.forEach(
     (button) => {
    button.addEventListener("click", () => {
      this.move(button)
          })
    })
    
    // reset the game
    this.reset.addEventListener("click", () => this.resetState())
  }
  
  /** ------------ actions ------------ **/
  
  // move a button from question to answer
  // or vice versa
   move(button) {
    // check if we are in anwsers or questions
    const parentClass = button.parentElement.className
    if (parentClass === "question") {
      // move to answers
      this.answers.appendChild(button)
    } else {
      // move to question
      this.question.appendChild(button)
    }

    // is the game over?
    this.evaluateAnswer()
   }
  
  
  // reset the game
  resetState() {
    // move all buttons back to question
    this.buttons.forEach(button => this.question.appendChild(button))
    // and hide feedback
    this.hideFeedback()
  }

/** ------------ eval ------------ **/

  
  // the game is over when button[data-answer] order increases sequentially
     isGameWon() {
  
        // get all the buttons
      const answerButtons = this.answers.querySelectorAll("button")
        
       // assume the solution is correct
       // until we see the wrong order
       let success = true
       
      for ( let i = 0; i < answerButtons.length; i++) {
          const button = answerButtons[i]
          const order = button.dataset.answer
  
          // this loop's counter matches the expected order (0,1,2,etc)
        if (order != i) {
          // if we see any buttons with incorrect 
          // the solution is incorrect
            success = false
            // no need to keep checking
            break
          }
        }
      return success
    }

}
  
/******************************
       Odd one out 
*******************************/
class OddOneOut extends GameWithFeedback {
  constructor(game) {
    // call the parent class constructor
    super(game)
    
  }

   /** ------------ init ------------ **/
  cacheNodes(game) {
    this.game = game
    this.tip = game.querySelector(".tip")
    this.success = game.querySelector(".success")
    this.buttons = game.querySelectorAll(".question button")
    this.reset = game.querySelector(".reset")
  }

  attachEventListeners() {
 
  this.buttons.forEach(
     (button) => {
    button.addEventListener("click", () => {
      this.select(button)
      this.evaluateAnswer()
          })
    })
    
    this.reset.addEventListener("click", () => this.resetState())
  }


  // deselect all buttons
  clearSelected() {
    this.game.querySelectorAll(".button--is-selected").forEach(button => button.classList.remove("button--is-selected"))

  }

  select(button) {
    // clear current selection
    this.clearSelected()
    
    // select this button
    button.classList.add("button--is-selected")
  }
  
  resetState() {
    // clear selected
    this.clearSelected()

  }

  isAnswerComplete() {
// we should have one button selected
    const selected = this.game.querySelector(".button--is-selected")

    // cast selected to boolean
    return !!selected
  }
  
  // override the game won check from parent class
  isGameWon() {
    // only the correct answer has [data-answer]
    const answer = selected.dataset.answer
    return !!answer
  }
}


/******************************
       Categories 
*******************************/
class Categories extends GameWithFeedback {
  constructor(game) {
    super(game)
    
  }

  /** ------------ game state ------------ **/
  // is a button selected and ready to move?
  isMoving = false

   /** ------------ init ------------ **/
  cacheNodes(game) {
    this.game = game
    this.tip = game.querySelector(".tip")
    this.success = game.querySelector(".success")
    this.question = game.querySelector(".question")
    this.buttons = game.querySelectorAll(".question button")
    this.selects = game.querySelectorAll(".select")
    this.reset = game.querySelector(".reset")
  }

  attachEventListeners() {
    this.buttons.forEach(button => button.addEventListener("click", () => {
      // if the button is in answers the return it to question

      // is the clicked button already in answers?
      const parentClass = button.parentElement.className
      if (parentClass !== "question") {
        // yes - move back to question
        this.question.appendChild(button)
        this.stopMove()
        return
      }
      // no - button is in question

      // are we already moving?
      if (this.isMoving) {
        // yes - cancel the current move
        this.stopMove()
      }

      // ready this button for moving
      this.startMove(button)
    }))

    // selects are only visible when we have
    // a button chosen to move
    this.selects.forEach(select => {
      select.addEventListener("click", () => {
        // find the answer container that this select belongs to
        const container = select.parentElement.querySelector("[data-answer]")
        const button = this.game.querySelector(".button--is-selected")
        // move the button into the chosen container
        container.appendChild(button)
        // reset move state
        this.stopMove()
      })
    })

    // reset the game
    this.reset.addEventListener("click", () => this.resetState())
    
  }
  
  // reset the game
  resetState(){
    // move all buttons back to question
    this.buttons.forEach(button => this.question.appendChild(button))
    // clear move state
    this.stopMove()
  }

  /** ------------ eval ------------ **/
  
  isGameWon() {
    // each answer div should contain only buttons with the same answer
    const containers = this.game.querySelectorAll("div[data-answer]")

    // <every> answer container must be in a valid state
    return Array.from(containers).every(div => {
      // what is the correct answer for this container?
      const answer = div.dataset.answer
      // grab all the chosen buttons in this container
      const choices = div.querySelectorAll("button")

      // <every> item in the container must be in the right place for the container to be valid
      const result = Array.from(choices).every(choice => {
        // do all buttons in this container 
        // match the container answer?
        return choice.dataset.answer == answer
      })

      return result
    })
  }
  
  /** ------------ feedback ------------ **/
  startMove(button) {
    // select the chosen button
    button.classList.add("button--is-selected")
    // update game state to reveal the select buttons
    this.isMoving = true
    this.game.classList.add("game--is-moving")
  }
  
  stopMove() {
    // clear all currently selected buttons
    this.game.querySelectorAll(".button--is-selected").forEach(button => button.classList.remove("button--is-selected"))
    
    // clear the moving game state
    this.isMoving = false
    this.game.classList.remove("game--is-moving")
      this.evaluateAnswer()

  }
    
}

  
  


    

const initGames = () => {
  
  const orderGames = document.querySelectorAll("[data-game='order-the-words']")
  orderGames.forEach(game =>
    new OrderTheWords(game)
  )

  const oddGames = document.querySelectorAll("[data-game='odd-one-out']")
  oddGames.forEach(game =>
    new OddOneOut(game)
  )

  const categoriesGames = document.querySelectorAll("[data-game='categories']")
  categoriesGames.forEach(game =>
    new Categories(game)
  )
} 
      









initGames()

