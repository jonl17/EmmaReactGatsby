import React from "react"
import { connect } from "react-redux"
import styled from "styled-components"
import { setScreenSize, getWorks } from "../../state/actions"

/*
    This class component initializes the data from WP into the
    redux store. Which it receives from page => index
 */

const Container = styled.div`
  display: grid;
  height: 100%;
  width: 100%;
  justify-content: center;
`

class Wrap extends React.Component {
  componentDidMount() {
    if (this.props.artworks !== undefined) {
      this.props.dispatch(getWorks(this.props.artworks))
    }
    this.props.dispatch(setScreenSize(window.innerWidth))
    document.addEventListener("resize", () => {
      this.props.dispatch(setScreenSize(window.innerWidth))
    })
  }
  render() {
    const { children } = this.props
    return <Container>{children}</Container>
  }
}

export default connect(null)(Wrap)
