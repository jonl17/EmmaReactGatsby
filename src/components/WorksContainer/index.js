import React from "react"

/** components */
import Block from "../NewsBlock"
import Img from "gatsby-image"
import ExitBtn from "../ExitButton"
import NextBtn from "../NextButton"
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
      <ExitBtn></ExitBtn>
      <TitleContainer>
        <Title>{artwork.title.replace("#038;", "")}</Title>
        <Year>{year}</Year>
      </TitleContainer>
      <DescriptionBox>
        <p>{description}</p>
        <p>{material}</p>
      </DescriptionBox>
      {myndir.map((item, index) => (
        <Block key={index}>
          {item.mynd.myndaskra === null ? (
            ""
          ) : (
            <Img
              fluid={item.mynd.myndaskra.localFile.childImageSharp.fluid}
            ></Img>
          )}
          {item.mynd.undirtexti ? <p>{item.mynd.texti}</p> : ""}
        </Block>
      ))}
      <NextBtn></NextBtn>
    </ContainerStyled>
  )
}

export default Container
