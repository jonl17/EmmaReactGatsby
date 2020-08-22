import React from "react"

/** components */
import { PageWrapStyle } from "./Styled"

const PageWrap = ({ children }) => {
  return <PageWrapStyle>{children}</PageWrapStyle>
}

export default PageWrap
