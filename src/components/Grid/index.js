import styled, { css } from "styled-components"

export const NewsGrid = styled.div`
  display: grid;
  grid-gap: 75px;
  width: 100%;
  grid-template-rows: repeat(auto-fill, minmax(200px, 1fr));
  margin: auto;
  box-sizing: border-box;
  max-width: 750px;
  padding-top: 50px;
  ${props =>
    props.device === `mobile` &&
    css`
      grid-gap: 10px;
      padding-top: 0;
    `}
`

export const Grid = styled.div`
  display: grid;
  grid-gap: 10px;
  height: 100%;
  width: 100%;
  max-width: 750px;
  margin: auto;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  box-sizing: border-box;
  padding: 25px;
`
