import React from "react"

import Block from "../NewsBlock"
import Img from "gatsby-image"
import ExitBtn from "../ExitButton"
import NextBtn from "../NextButton"

import { connect } from "react-redux"

import {
  ContainerStyled,
  TitleContainer,
  Year,
  Title,
  DescriptionBox,
} from "./Styled"

const Container = ({ artwork, device }) => {
  const { description, myndir, material, year } = artwork.acf
  console.log(artwork)
  return (
    <ContainerStyled>
      <ExitBtn></ExitBtn>
      <TitleContainer device={device}>
        <Title>{artwork.title.replace("#038;", "")}</Title>
        <Year device={device}>{year}</Year>
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

const mapStateToProps = state => ({
  device: state.reducer.device,
})

export default connect(mapStateToProps)(Container)
