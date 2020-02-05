import styled, { css } from "styled-components"

export const ContainerStyled = styled.div`
  ${props =>
    props.device === `mobile` &&
    css`
      display: grid;
      grid-gap: 15px;
      box-sizing: border-box;
      padding: 0px;
    `}
`

export const TitleContainer = styled.div`
  display: grid;
  margin-top: 25px;
  ${props =>
    props.device === `browser` &&
    css`
      grid-template-columns: auto 1fr;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      grid-template-columns: auto 1fr;
    `}

  ${props =>
    props.device === `mobile` &&
    css`
      grid-template-columns: 1fr;
      grid-template-rows: 1fr 1fr;
    `}
`

export const Year = styled.h2`
  margin-top: auto;
  margin-bottom: auto;
  font-size: 20px;
  ${props =>
    props.device === `browser` &&
    css`
      text-align: right;
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      text-align: right;
    `}
  ${props =>
    props.device === `mobile` &&
    css`
      text-align: left;
    `}

`
export const Title = styled.h1`
  margin: 0;
  font-size: 20px;
`

export const DescriptionBox = styled.div`
  padding-top: 25px;
  padding-bottom: 25px;
`
