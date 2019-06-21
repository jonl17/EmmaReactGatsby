import styled, { css } from "styled-components"

export const NewsGrid = styled.div`
  display: grid;
  grid-gap: 75px;
  height: 100%;
  width: 100%;
  ${props =>
    props.device === `browser` &&
    css`
      padding: 25px;
      grid-template-columns: repeat(1, 800px);
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(1, 600px);
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(1, 400px);
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(1, 300px);
    `}
`

export const Grid = styled.div`
  display: grid;
  grid-gap: 10px;
  height: 100%;
  width: 100%;

  ${props =>
    props.device === `browser` &&
    css`
      padding: 25px;
      grid-template-columns: repeat(5, 150px);
    `}
  ${props =>
    props.device === `tablet` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(4, 150px);
    `}
  ${props =>
    props.device === `mobileL` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(3, 150px);
    `}
  ${props =>
    props.device === `mobileS` &&
    css`
      padding: 25px 0 25px 0;
      grid-template-columns: repeat(2, 150px);
    `}
`
