import React from "react"
import styled from "styled-components"

const Text = styled.p`
  color: white;
  margin: auto;
  text-align: center;
  font-size: 20px;
`
const TextBox = styled.div`
  display: grid;
  position: absolute;
  background-color: rgba(16, 16, 16, 0.3);
  height: 100%;
  width: 100%;
  z-index: 12;
  top: 0;
  left: 0;
  opacity: ${props => props.opacity};
`
class FrontBoxText extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      opacity: 0,
    }
  }
  handleHover() {
    this.setState({
      opacity: 1,
    })
  }
  handleOut() {
    this.setState({
      opacity: 0,
    })
  }
  render() {
    const { children } = this.props
    return (
      <TextBox
        onMouseOver={() => this.handleHover()}
        onMouseOut={() => this.handleOut()}
        opacity={this.state.opacity}
      >
        <Text>{children}</Text>
      </TextBox>
    )
  }
}

export default FrontBoxText
