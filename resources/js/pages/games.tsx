import Footer from '@/components/footer';
import Header from '@/components/header';
import Downloadables from '@/components/downloadables';
import { ReactNode, useEffect, useState } from 'react';

type GamesProps = {
  group: {
    title: string;
    slug: string;
    course?: {
      title: string;
      access_code: string;
    };
  };
  gamesData: {
    reorder_games: any[];
    odd_one_out_games: any[];
    category_games: any[];
    match_up_games: any[];
    games_active: boolean;
  };
};

type AuthGuardProps = {
  children?: ReactNode;
  correctPassword: string;
  slug: string;
  group: {
    title: string;
    slug: string;
  };
};

function AuthGuard({ children, correctPassword, slug, group }: AuthGuardProps) {
  const [password, setPassword] = useState('');
  const [authenticated, setAuthenticated] = useState(false);

  const handleClick = () => {
    setAuthenticated(password === correctPassword);
  };

  const cleanUpSavedPassword = () => {
    localStorage.removeItem(`auth_${slug}`);
  };

  useEffect(() => {
    if (authenticated) {
      // save the password to localStorage
      localStorage.setItem(`auth_${slug}`, password);
    } else {
      // wrong pass, delete the password
      cleanUpSavedPassword();
    }
  }, [authenticated]);

  useEffect(() => {
    // check for a saved password in localStorage
    const savedPassword = localStorage.getItem(`auth_${slug}`);
    if (savedPassword) {
      if (savedPassword === correctPassword) {
        setAuthenticated(true);
        setPassword(savedPassword);
      } else {
        cleanUpSavedPassword();
      }
    }
  }, []);

  if (!authenticated) {
    return (
      <div className="flex min-h-screen flex-col text-black" style={{ backgroundColor: '#FEF4F3' }}>
        <Header name={group.title} />
        <main className="flex flex-col md:flex-row justify-between items-stretch pr-10">
          <div className="mx-auto max-w-[1200px] px-2 py-10 order-[2]">
            This course requires an access code.
            <br />
            Please enter your code below
            <input
              type="password"
              value={password}
              placeholder="Enter code"
              onChange={(e) => setPassword(e.target.value)}
              onKeyDown={(e) => {
                if (e.key === 'Enter') {
                  handleClick();
                }
              }}
              className="mb-4 w-full rounded-lg border border-black bg-white px-4 py-2 text-black"
            />
            <button
              onClick={handleClick}
              className="rounded bg-blue-500 px-6 py-2 text-center text-white transition hover:bg-blue-600"
            >
              Authenticate
            </button>
          </div>
          <Downloadables course={group.slug} />
        </main>
        <Footer />
      </div>
    );
  }

  return <>{children}</>;
}

function OddOneOutGameComponent({ games }: { games: any[] }) {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [selectedWords, setSelectedWords] = useState<string[]>([]);
  const [availableWords, setAvailableWords] = useState<string[]>([]);
  const [showHint, setShowHint] = useState(false);
  const [message, setMessage] = useState('Find the odd one out.');
  const [nextButtonMessage, setNextButtonMessage] = useState('');
  const [isCorrect, setIsCorrect] = useState(false);

  const currentGame = games[currentIndex];

  // Initialize words whenever currentGame changes
  useEffect(() => {
    if (currentGame) {
      setAvailableWords(currentGame.fields.question.split("\n"));
      setSelectedWords([]);
      setShowHint(false);
    }
  }, [currentGame]);

  if (!currentGame) return <p>No Odd One Out games available.</p>;

  const handleWordClick = (word: string) => {
    const newSelected = [...selectedWords, word];
    const newAvailable = availableWords.filter((w) => w !== word);

    setSelectedWords(newSelected);
    setAvailableWords(newAvailable);
    handleCheckAnswer(newSelected);
  };

  const handleReset = () => {
    setAvailableWords(currentGame.fields.question.split("\n"));
    setSelectedWords([]);
    setIsCorrect(false);
  };

  const handleCheckAnswer = (words = selectedWords) => {
    const answer = words.join(" ");
    if (answer === currentGame.fields.solution) {
        setIsCorrect(true);
      const nextIndex = currentIndex + 1;
      if (nextIndex < games.length) {
        setNextButtonMessage("Next Question");
        setMessage("Well done!");
      } else {
        setMessage("You finished all Odd One Out games!");
        setNextButtonMessage("Next Game");
      }
      setShowHint(false);
    } else {
      setMessage("Incorrect. Try again!");
      handleReset();
      setShowHint(true);
    }
  };

  const handleClickNext = () => {
    const nextIndex = currentIndex + 1;
    if(nextIndex < games.length){
      setCurrentIndex(nextIndex);
    }
    else{
      setCurrentIndex(0); //Change to load next game later!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    const [message, setMessage] = useState('Find the odd one out.');
    setSelectedWords([]);
    setIsCorrect(false);
  }

  return (
    <div className="space-y-4">
      <div>
        {message}
      </div>

      {/* Available words */}
      <div className="flex flex-wrap gap-2">
        {availableWords.map((word, i) => (
          <button
            key={i}
            onClick={() => handleWordClick(word)}
            className="px-3 py-1 bg-blue-200 rounded hover:bg-blue-300"
          >
            {word}
          </button>
        ))}
      </div>

      {/* Selected words */}
      <div className="flex flex-wrap gap-2 mt-2 min-h-[2rem]">
        {selectedWords.map((word, i) => (
          <button key={i} className="px-3 py-1 bg-green-200 rounded">
            {word}
          </button>
        ))}
      </div>

      {/* Buttons */}
      <div className="space-x-2 mt-2">
        {/*<button
          onClick={handleCheckAnswer}
          className="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600"
        >
          Check Answer
        </button>*/}
        <button
          onClick={handleReset}
          className="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
          Reset
        </button>
        {isCorrect && <button
          onClick={() => handleClickNext()}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300">
          {nextButtonMessage}
        </button>}
        {/*<button
          onClick={() => setShowHint(!showHint)}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300"
        >
          {showHint ? "Hide Hint" : "Show Hint"}
        </button>*/}
      </div>

      {/* Hint */}
      {showHint && (
        <p className="mt-2 text-sm text-gray-700">
          Hint: {currentGame.fields.hint}
        </p>
      )}
    </div>
  );
}

function ReorderGameComponent({ games }: { games: any[] }) {
  const [currentIndex, setCurrentIndex] = useState(0);
  const [selectedWords, setSelectedWords] = useState<string[]>([]);
  const [availableWords, setAvailableWords] = useState<string[]>([]);
  const [showHint, setShowHint] = useState(false);
  const [message, setMessage] = useState('Put words in correct order.');
  const [nextButtonMessage, setNextButtonMessage] = useState('');
  const [isCorrect, setIsCorrect] = useState(false);

  const currentGame = games[currentIndex];

  // Initialize words whenever currentGame changes
  useEffect(() => {
    if (currentGame) {
      setAvailableWords(currentGame.fields.question.split(" "));
      setSelectedWords([]);
      setShowHint(false);
    }
  }, [currentGame]);

  if (!currentGame) return <p>No reorder games available.</p>;

  const handleWordClick = (word: string) => {
    const newSelected = [...selectedWords, word];
    const newAvailable = availableWords.filter((w) => w !== word);

    setSelectedWords(newSelected);
    setAvailableWords(newAvailable);

    // If there are no words left, auto-check
    if (newAvailable.length === 0) {
      handleCheckAnswer(newSelected);
    }
  };

  const handleSelectedWordClick = (word: string) => {
    setAvailableWords([...availableWords, word]);
    setSelectedWords(selectedWords.filter((w) => w !== word));
  }

  const handleReset = () => {
    setAvailableWords(currentGame.fields.question.split(" "));
    setSelectedWords([]);
    setIsCorrect(false);
  };

  const handleCheckAnswer = (words = selectedWords) => {
    const answer = words.join(" ");
    if (answer === currentGame.fields.solution) {
        setIsCorrect(true);
      const nextIndex = currentIndex + 1;
      if (nextIndex < games.length) {
        setNextButtonMessage("Next Question");
        setMessage("Well done!");
      } else {
        setMessage("You finished all reorder games!");
        setNextButtonMessage("Next Game");
      }
      setShowHint(false);
    } else {
      setMessage("Incorrect. Try again!");
      handleReset();
      setShowHint(true);
    }
  };

  const handleClickNext = () => {
    const nextIndex = currentIndex + 1;
    if(nextIndex < games.length){
      setCurrentIndex(nextIndex);
    }
    else{
      setCurrentIndex(0); //Change to load next game later!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    setMessage("Put words in correct order.");
    setSelectedWords([]);
    setIsCorrect(false);
  }

  return (
    <div className="space-y-4">
      <div>
        {message}
      </div>

      {/* Available words */}
      <div className="flex flex-wrap gap-2">
        {availableWords.map((word, i) => (
          <button
            key={i}
            onClick={() => handleWordClick(word)}
            className="px-3 py-1 bg-blue-200 rounded hover:bg-blue-300"
          >
            {word}
          </button>
        ))}
      </div>

      {/* Selected words */}
      <div className="flex flex-wrap gap-2 mt-2 min-h-[2rem]">
        {selectedWords.map((word, i) => (
          <button key={i} onClick={() => handleSelectedWordClick(word)} className="px-3 py-1 bg-green-200 rounded">
            {word}
          </button>
        ))}
      </div>

      {/* Buttons */}
      <div className="space-x-2 mt-2">
        {/*<button
          onClick={handleCheckAnswer}
          className="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600"
        >
          Check Answer
        </button>*/}
        <button
          onClick={handleReset}
          className="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
          Reset
        </button>
        {isCorrect && <button
          onClick={() => handleClickNext()}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300">
          {nextButtonMessage}
        </button>}
        {/*<button
          onClick={() => setShowHint(!showHint)}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300"
        >
          {showHint ? "Hide Hint" : "Show Hint"}
        </button>*/}
      </div>

      {/* Hint */}
      {showHint && (
        <p className="mt-2 text-sm text-gray-700">
          Hint: {currentGame.fields.hint}
        </p>
      )}
    </div>
  );
}

function MatchUpGameComponent({games}: {games: any[]}){
  const [currentIndex, setCurrentIndex] = useState(0);
  const [message, setMessage] = useState('Match English to French');
  const [matchedWords, setMatchedWords] = useState<string[]>([]);
  const [englishWords, setEnglishWords] = useState<string[]>([]);
  const [frenchWords, setFrenchWords] = useState<string[]>([]);
  const [isCorrect, setIsCorrect] = useState(false);
  const [nextButtonMessage, setNextButtonMessage] = useState('');
  const [clickedIndex, setClickedIndex] = useState<number|null>(null);

  const currentGame = games[currentIndex];

  function shuffle(array:string[]) {
  let currentIndex = array.length;

  if(currentIndex === 0){
    return [""];
  }

  // While there remain elements to shuffle...
  while (currentIndex != 0) {

    // Pick a remaining element...
    let randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // And swap it with the current element.
    [array[currentIndex], array[randomIndex]] = [
      array[randomIndex], array[currentIndex]];
  }

  return(array);
}

  useEffect(() => {
  if (!currentGame) return;

  const lines: string[] = currentGame.fields.game.split("\n");
  setMatchedWords(lines);

  const parsed: { word: string; category: string }[] = lines.map((item: string) => {
    const [word, category] = item.split(":").map(s => s.trim());
    return { word, category };
  });

  let tempFrenchWords: string[] = lines.map((item:string) =>{
    return (item.substring(0, item.indexOf(":")));
  });
  
  //tempFrenchWords = shuffle(tempFrenchWords);

  let tempEnglishWords: string[] = lines.map((item:string) =>{
    return (item.substring(item.indexOf(":")+1));
  });

  tempEnglishWords = shuffle(tempEnglishWords);

  setFrenchWords(tempFrenchWords);
  setEnglishWords(tempEnglishWords);
  
  }, [currentGame]);

  const handleWordClick = (i:number) => {
    const currentClickedIndex = clickedIndex;
    if(currentClickedIndex===i){
      setClickedIndex(null);
    }
    else if (clickedIndex===null){
      setClickedIndex(i);
    }
    else{
      let tempArray = [...englishWords];
      [tempArray[i], tempArray[clickedIndex]] = [tempArray[clickedIndex], tempArray[i]];
      setEnglishWords(tempArray);
      setClickedIndex(null);
    }
  }

  const handleCheckAnswer = () => {
    const tempEnglish = [...englishWords];
    const tempFrench = [...frenchWords];

    let potentialAnswer:string[] = [];

    for(let i=0;i<tempEnglish.length;i++){
      potentialAnswer.push(tempFrench[i]+":"+tempEnglish[i]);
    }

    const isMatch =
      potentialAnswer.length === matchedWords.length &&
      potentialAnswer.every((value, index) => value === matchedWords[index]);

      setMessage("Not quite. Try again!");

    if (isMatch) {
      setIsCorrect(true);
      setMessage("Well done!");
      setNextButtonMessage("Next Question");
    }
  }

  const handleClickNext = () => {
    const nextIndex = currentIndex + 1;
    if(nextIndex < games.length){
      setCurrentIndex(nextIndex);
    }
    else{
      setCurrentIndex(0); //Change to load next game later!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    setMessage('Match English to French');
    setIsCorrect(false);
  }

  return(
  <div className="space-y-4">
    <div>
      {message}
    </div>

    {/*English Words*/}
      <div className="flex flex-wrap gap-2 justify-evenly">
        {englishWords.map((word, i) => (
          <button
            key={i}
            onClick={() => handleWordClick(i)}
            className={
              clickedIndex === i
                ? "px-3 py-1 bg-yellow-300 rounded hover:bg-yellow-300"
                : "px-3 py-1 bg-blue-200 rounded hover:bg-blue-300"
            }
          >
            {word}
          </button>
        ))}
      </div>

      {/*French Words*/}
      <div className="flex flex-wrap gap-2 justify-evenly">
        {frenchWords.map((word, i) => (
          <button
            key={i}
            //onClick={() => handleWordClick(word)}
            className="px-3 py-1 bg-blue-200 rounded hover:bg-blue-300"
          >
            {word}
          </button>
        ))}
      </div>

        <button
          onClick={handleCheckAnswer}
          className="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600"
        >
          Check Answer
        </button>

      {isCorrect && <button
          onClick={() => handleClickNext()}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300">
          {nextButtonMessage}
        </button>}
  </div>
  )
}

function CategoriesGameComponent({ games }: { games: any[] }){
  const [currentIndex, setCurrentIndex] = useState(0);
  const [wordsAndCategories, setWordsAndCategories] = useState<string[]>([]);
  const [availableWords, setAvailableWords] = useState<string[]>([]);
  const [clickedIndex, setClickedIndex] = useState<number|null>(null);
  const [categories, setCategories] = useState<string[]>([]);
  const [message, setMessage] = useState('Put words in the right category.');
  const [selectedWord, setSelectedWord] = useState("");
  const [categoryWords, setCategoryWords] = useState<{[key:string]:string[]}>({});
  const [nextButtonMessage, setNextButtonMessage] = useState('');
  const [isCorrect, setIsCorrect] = useState(false);
  const [dragSource, setDragSource] = useState<string | null>(null);


  const currentGame = games[currentIndex];

  useEffect(() => {
  if (!currentGame) return;

  const lines: string[] = currentGame.fields.game.split("\n");
  setWordsAndCategories(lines);

  const parsed: { word: string; category: string }[] = lines.map((item: string) => {
    const [word, category] = item.split(":").map(s => s.trim());
    return { word, category };
  });

  setAvailableWords(parsed.map(p => p.word));

  const newCategories: string[] = [...new Set(parsed.map(p => p.category))];
  setCategories(newCategories);

  const tempObject: { [key: string]: string[] } = newCategories.reduce((acc, cat) => {
    acc[cat] = [];
    return acc;
  }, {} as { [key: string]: string[] });

  setCategoryWords(tempObject);

  }, [currentGame]);


  if (!currentGame) return <p>No Category games available.</p>;

  const handleReset = () => {

    const lines: string[] = currentGame.fields.game.split("\n");

    const parsed: { word: string; category: string }[] = lines.map((item: string) => {
      const [word, category] = item.split(":").map(s => s.trim());
      return { word, category };
    });

    setAvailableWords(parsed.map(p => p.word));

    const resetCategoryWords = categories.reduce((acc, cat) => {
      acc[cat] = [];
      return acc;
    }, {} as { [key: string]: string[] });

    setCategoryWords(resetCategoryWords);
    setSelectedWord("");
    setClickedIndex(null);
    setIsCorrect(false);
  }

  const handleClickNext = () => {
    const nextIndex = currentIndex + 1;
    if(nextIndex < games.length){
      setCurrentIndex(nextIndex);
    }
    else{
      setCurrentIndex(0); //Change to load next game later!!!!!!!!!!!!!!!!!!!!!!!!!
    }
    setMessage('Put words in the right category.');
    
    setSelectedWord("");
    setClickedIndex(null);
    setIsCorrect(false);
  }

  const handleWordClick = (word: string, i:number) => {
    const currentClickedIndex = clickedIndex;
    if(currentClickedIndex===i){
      setClickedIndex(null);
      setSelectedWord("");
    }
    else{
      setClickedIndex(i);
      setSelectedWord(word);
    }
  }

  const handleCategoryClick = (category: string) => {
    if(selectedWord){
      let tempCategoryWords = { ...categoryWords };
      if (!tempCategoryWords[category].includes(selectedWord)) {
        tempCategoryWords[category] = [...tempCategoryWords[category], selectedWord];
        setCategoryWords(tempCategoryWords);
        const newAvailable = availableWords.filter(w => w !== selectedWord);
        setAvailableWords(newAvailable);
        setClickedIndex(null);

        if (newAvailable.length === 0) {
          handleCheckAnswer(tempCategoryWords);
        }
      }
    }
  }

  const handleCheckAnswer = (
    userCategories: { [key: string]: string[] } = categoryWords
  ) => {
    const parsed = wordsAndCategories.map(item => {
      const [word, category] = item.split(":").map(s => s.trim());
      return { word, category };
    });

    const allCorrect = parsed.every(({ word, category }) => {
      return userCategories[category]?.includes(word);
    });

    if (allCorrect) {
      setIsCorrect(true);
      setMessage("Well done!");
      setNextButtonMessage("Next Question");
    } else {
      setIsCorrect(false);
      setMessage("Some words are in the wrong category. Try again.");
      handleReset();
    }
  };


  return (
  <div className="space-y-4">
      <div>
        {message}
      </div>

    {/* Available words */} 
    <div 
      onDragOver={(e) => e.preventDefault()}
      onDrop={() => {
        let tempCategoryWords = { ...categoryWords };
        let tempAvailableWords = [...availableWords];
        if (dragSource && dragSource !== "available") {
          tempAvailableWords = [...tempAvailableWords, selectedWord];
          setAvailableWords(tempAvailableWords);
          tempCategoryWords[dragSource] = tempCategoryWords[dragSource].filter(w => w !== selectedWord);
          setCategoryWords(tempCategoryWords);
        }
        setSelectedWord("");
      }}
      className="flex flex-wrap gap-2"
    >
      {availableWords.map((word, i) => (
        <button
          key={i}
          draggable="true"
          onDragStart={() => {
            setSelectedWord(word);
            setDragSource("available");
          }}
          onClick={() => handleWordClick(word, i)}
          className={
            clickedIndex === i || selectedWord === word
              ? "px-3 py-1 bg-yellow-300 rounded hover:bg-yellow-300" // clicked or being dragged
              : "px-3 py-1 bg-blue-200 rounded hover:bg-blue-300"      // normal
          }
        >
          {word}
        </button>
      ))}
    </div>

        
      {/* Categories */}
      <div className="flex flex-col gap-4">
        {categories.map((category, i) => (
          <div
            key={i}
            onDragOver={(e) => e.preventDefault()}
            onDrop={() => {
              if(dragSource==="available")
              {
                handleCategoryClick(category);
              }
              else{
                let tempCategoryWords = { ...categoryWords };
                if (!tempCategoryWords[category].includes(selectedWord) && dragSource) {
                  tempCategoryWords[category] = [...tempCategoryWords[category], selectedWord];
                  tempCategoryWords[dragSource] = tempCategoryWords[dragSource].filter(w => w !== selectedWord);
                  setCategoryWords(tempCategoryWords);
                }
              }
              setSelectedWord("");
            }}
            onClick={() => handleCategoryClick(category)}
            className="px-2 py-1 bg-gray-200 hover:bg-gray-300 rounded"
          >
            <div className="font-bold">{category}</div>
            <div className="flex gap-1 mt-1">
              {categoryWords[category].map((word, j) => (
                <div
                  key={j}
                  draggable="true"
                  onDragStart={()=>{
                    setSelectedWord(word);
                    setDragSource(category);
                  }}
                  className={
                    selectedWord === word
                      ? "px-2 py-1 bg-yellow-300 rounded" // being dragged → yellow
                      : "px-2 py-1 bg-gray-300 rounded"   // normal
                  }
                >
                  {word}
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>
        <div>
          <button
          onClick={handleReset}
          className="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
        >
          Reset
        </button>
        {isCorrect && <button
          onClick={() => handleClickNext()}
          className="px-4 py-2 bg-yellow-200 rounded hover:bg-yellow-300">
          {nextButtonMessage}
        </button>}
        </div>
 
  </div>
  )
}

export default function Games({ group, gamesData }: GamesProps) {
  return (
    <AuthGuard correctPassword={group.course?.access_code || ''} slug={group.slug} group={group}>
      <div className="flex min-h-screen flex-col text-black" style={{ backgroundColor: '#FEF4F3' }}>
        <Header name={group.title} />
        <main className="flex flex-col items-stretch justify-between pr-10 md:flex-row">
          <div className="order-[2] mx-auto w-full max-w-[1200px] px-2 py-10">
            <h1 className="mb-6 text-2xl font-bold">Games</h1>

            {!gamesData.games_active && (
              <div className="mb-4 rounded-lg bg-yellow-100 p-4 text-yellow-800">
                <p>Games are currently inactive for this course.</p>
              </div>
            )}

            <div className="space-y-8">
              {/* Reorder Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Reorder Games</h2>

                <ReorderGameComponent games={gamesData.reorder_games} />
              </div>

              {/* Odd One Out Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Odd One Out Games</h2>
                {/*<pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.odd_one_out_games, null, 2)}
                </pre>*/}
                <OddOneOutGameComponent games={gamesData.odd_one_out_games} />
              </div>

              {/* Category Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Category Games</h2>
                {/*<pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.category_games, null, 2)}
                </pre>*/}
                <CategoriesGameComponent games={gamesData.category_games} />
              </div>

              {/* Match Up Games */}
              <div className="rounded-lg bg-white p-6 shadow">
                <h2 className="mb-4 text-xl font-semibold">Match Up Games</h2>
                <pre className="overflow-x-auto rounded bg-gray-100 p-4 text-sm">
                  {JSON.stringify(gamesData.match_up_games, null, 2)}
                </pre>
                <MatchUpGameComponent games = {gamesData.match_up_games} />
              </div>
            </div>
          </div>
          <Downloadables course={group.slug} />
        </main>
        <Footer />
      </div>
    </AuthGuard>
  );
}

