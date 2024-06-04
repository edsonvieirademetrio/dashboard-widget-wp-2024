import React, {useState} from "react"
import"./App.scss"
export function App(){
    const[counter, setCounter] = useState(0)
    const increment = () => setCounter(counter + 1)
}