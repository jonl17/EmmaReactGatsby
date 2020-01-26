import React from "react"
import { useSelector, useDispatch } from "react-redux"
import { setPagenamePrefix } from "../../state/actions"
import { Link } from "gatsby"

/** components */
import { NewExitButton, Line } from "./Styled"

/* Exit btn */
const ExitBtn = ({ display }) => {
  const device = useSelector(state => state.reducer.device)
  const dispatch = useDispatch()
  return (
    <Link onClick={() => dispatch(setPagenamePrefix(""))} to={"/"}>
      <NewExitButton device={device} display={display}>
        <Line differ />
        <Line />
      </NewExitButton>
    </Link>
  )
}

export default ExitBtn
