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
  padding-bottom: 50px;
  ${props =>
    props.device === `mobile` &&
    css`
      grid-gap: 10px;
      padding: 0 33px 75px 33px;
    `}
`

export const Grid = styled.div`
  display: flex;
  height: 100%;
  width: 100%;
  max-width: 750px;
  margin: auto;
  flex-wrap: wrap;
  box-sizing: border-box;
  padding: 25px 25px 75px 25px;
`
