import React from "react"
import { Link } from "gatsby"

/** components */
import { NewExitButton, Line } from "./Styled"

/* Exit btn */
const ExitBtn = ({ display }) => {
  return (
    <Link to='/'>
      <NewExitButton device={device} display={display}>
        <Line differ />
        <Line />
      </NewExitButton>
    </Link>
  )
}

export default ExitBtn
