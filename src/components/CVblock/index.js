import styled, { keyframes, css } from "styled-components"

export const Block = styled.div`
  width: 100%;
`
export const Title = styled.p`
  color: black;
  font-size: 20px;
  margin-bottom: 0;
`

const greenShine = keyframes`
  from {
    color: gray;
  }
  to {
    color: lightgreen;
  }
`
export const Item = styled.p`
  margin: 0;
  ${props =>
    props.upcoming === true &&
    css`
      animation: ${greenShine} 2s infinite alternate;
    `}
`
