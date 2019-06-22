import React from "react"
import styled, { css } from "styled-components"
import { connect } from "react-redux"

export const BlockStyled = styled.div`
  height: 100%;
  width: 100%;
  box-sizing: border-box;
  ${props =>
    props.device === `browser` &&
    css`
      padding-bottom: 50px;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      padding-bottom: 25px;
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      padding-bottom: 10px;
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      padding-bottom: 5px;
    `}
`

const Block = ({ children, device }) => {
  return <BlockStyled device={device}>{children}</BlockStyled>
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(Block)
