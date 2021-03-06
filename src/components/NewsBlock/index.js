import React from "react"
import styled, { css } from "styled-components"
import { connect } from "react-redux"

export const BlockStyled = styled.div`
  width: 100%;
  box-sizing: border-box;
  margin: auto;
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
    props.device === `mobile` &&
    css`
      padding-bottom: 25px;
    `}

`

const Block = ({ children, device }) => {
  return <BlockStyled device={device}>{children}</BlockStyled>
}

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(Block)
