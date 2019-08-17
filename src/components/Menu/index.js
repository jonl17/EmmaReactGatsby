import React from "react"
import { connect } from "react-redux"
import styled, { css } from "styled-components"
import MenuItem from "./Styled/MenuItem"

const Container = styled.div`
  display: flex;
  justify-content: space-between;
  ${props =>
    props.device === `browser` &&
    css`
      width: 300px;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      width: 300px;
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      width: 450px;
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      width: 250px;
    `}
`

const Menu = ({ menuItems, device }) => {
  return (
    <Container device={device}>
      {menuItems.map((item, index) => (
        <MenuItem
          hasmenu={index === 0 ? "true" : "false"}
          key={index}
          link={index === 0 ? "/" : "/" + item}
        >
          {item}
        </MenuItem>
      ))}
    </Container>
  )
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(Menu)
