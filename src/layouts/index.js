import React, { useEffect } from "react"
import "./fonts.css"
import { GlobalStyles } from "../components/GlobalStyles"
import { useDispatch, useSelector } from "react-redux"
import { SET_DEVICE } from "../state/actions"

/** components */
import { Container } from "./Styled"
import SEO from "../components/SEO"
import Header from "../components/Header"
import Copyright from "../components/Copyright"

const Layout = ({ children }) => {
  const dispatch = useDispatch()
  const callBack = () => {
    dispatch({ type: SET_DEVICE, width: window.innerWidth })
  }
  useEffect(() => {
    callBack()
    window.addEventListener("resize", callBack)
    return () => {
      window.removeEventListener("resize", callBack)
    }
  })
  const device = useSelector(state => state.reducer.device)
  return (
    <>
      <SEO></SEO>
      <GlobalStyles></GlobalStyles>
      <Container show={device !== undefined}>
        <Header></Header>
        {children}
      </Container>
      <Copyright></Copyright>
    </>
  )
}

export default Layout
