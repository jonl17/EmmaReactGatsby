import React from "react"
import { GlobalStyles } from "../components/GlobalStyles"
import { setDevice } from "../state/actions"
import { connect } from "react-redux"

/** components */
import { Container } from "./Styled"
import SEO from "../components/SEO"
import Header from "../components/Header"
import Copyright from "../components/Copyright"

class Layout extends React.Component {
  constructor(props) {
    super(props)
    this.callBack = this.callBack.bind(this)
  }
  componentDidMount() {
    this.callBack()
    window.addEventListener("resize", this.callBack)
  }
  componentWillUnmount() {
    window.removeEventListener("resize", this.callBack)
  }
  callBack() {
    const { dispatch } = this.props
    dispatch(setDevice(window.innerWidth))
  }
  render() {
    const { children, location } = this.props
    console.log(location.pathname)
    return (
      <>
        <SEO></SEO>
        <GlobalStyles></GlobalStyles>
        <Header></Header>
        <Container>{children}</Container>
        <Copyright></Copyright>
      </>
    )
  }
}

export default connect()(Layout)
