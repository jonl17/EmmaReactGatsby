import React from "react"

import Block from "../NewsBlock"
import Img from "gatsby-image"

import {
  ContainerStyled,
  TitleContainer,
  Year,
  Title,
  DescriptionBox,
} from "./Styled"

const Container = ({ artwork }) => {
  const { description, myndir, material, year } = artwork.acf
  return (
    <ContainerStyled>
      <TitleContainer>
        <Title>{artwork.title}</Title>
        <Year>{year}</Year>
      </TitleContainer>
      <DescriptionBox>
        <p>{description}</p>
        <p>{material}</p>
      </DescriptionBox>
      {myndir.map((item, index) => (
        <Block key={index}>
          <Img
            fluid={item.mynd.myndaskra.localFile.childImageSharp.fluid}
          ></Img>
          {item.mynd.undirtexti ? <p>{item.mynd.texti}</p> : ""}
        </Block>
      ))}
    </ContainerStyled>
  )
}

export default Container
