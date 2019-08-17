import React from "react"
import styled, { css } from "styled-components"
import Menu from "../Menu"
import { Link } from "gatsby"
import { connect } from "react-redux"

const Container = styled.div`
  height: 150px;
  width: 100%;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  justify-content: center;
  ${props =>
    props.device === `browser` &&
    css`
      padding: 25px 0 25px 50px;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      padding: 25px 0 25px 50px;
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      padding: 25px 0 25px 25px;
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      padding: 25px 0 25px 25px;
    `}
`

const Title = styled(Link)`
  font-size: 25px;
  text-decoration: none;
  color: black;
`

const Header = ({ metadata, device, works }) => {
  return (
    <Container device={device}>
      <Title to="/">{metadata.title}</Title>
      <Menu menuItems={metadata.menuItems}></Menu>
    </Container>
  )
}

const mapStateToProps = state => ({
  device: state.reducer.device,
  works: state.reducer.works,
})

export default connect(mapStateToProps)(Header)
