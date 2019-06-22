import React from "react"
import styled from "styled-components"
import { Link } from "gatsby"
import { connect } from "react-redux"

const MenuItemStyled = styled(Link)`
  margin: 15px 0 0 0;
  text-decoration: none;
  color: gray;
`

const DropDownMenuItem = styled(Link)`
  text-decoration: none;
  color: gray;
  margin: 0;
`
const DropDownText = styled.p`
  margin: 0;
  &&:hover {
    color: black;
  }
`

class MenuItem extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      displayMenu: `none`,
    }
  }
  handleHover() {
    if (this.props.device === `browser`) {
      this.setState({
        displayMenu: `block`,
      })
    }
  }
  handleHoverOff() {
    this.setState({
      displayMenu: `none`,
    })
  }
  render() {
    const { hasmenu, link, children } = this.props
    return (
      <MenuItemStyled
        activeStyle={{ color: `black` }}
        onMouseOut={() => this.handleHoverOff()}
        onMouseOver={
          hasmenu === "true" ? () => this.handleHover() : console.log("")
        }
        hasmenu={hasmenu}
        to={link}
      >
        {children}
        <div
          style={
            hasmenu === "true"
              ? {
                  position: "absolute",
                  display: `${this.state.displayMenu}`,
                  zIndex: 4,
                }
              : { display: `none` }
          }
        >
          {this.props.works.map((item, index) => (
            <DropDownMenuItem key={index} to={item.node.slug}>
              <DropDownText>{item.node.title}</DropDownText>
            </DropDownMenuItem>
          ))}
        </div>
      </MenuItemStyled>
    )
  }
}

const mapStateToProps = state => ({
  works: state.reducer.works,
  device: state.reducer.device,
})

export default connect(mapStateToProps)(MenuItem)
