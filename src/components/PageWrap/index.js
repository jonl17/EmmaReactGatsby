import React from "react"
import { useSelector } from "react-redux"

/** components */
import { PageWrapStyle } from "./Styled"

const PageWrap = ({ children }) => {
  const device = useSelector(state => state.reducer.device)
  return <PageWrapStyle device={device}>{children}</PageWrapStyle>
}

export default PageWrap
