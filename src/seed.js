import shortid from "shortid";

export default function seed(store) {
  const firstListId = shortid.generate();

  store.dispatch({
    type: "ADD_LIST",
    payload: { listId: firstListId, listTitle: "Todo" }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: firstListId,
      cardId: shortid.generate(),
      cardText: "Buy milk"
    }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: firstListId,
      cardId: shortid.generate(),
      cardText: "Buy eggs"
    }
  });

  const secondListId = shortid.generate();

  store.dispatch({
    type: "ADD_LIST",
    payload: { listId: secondListId, listTitle: "Doing" }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: secondListId,
      cardId: shortid.generate(),
      cardText: "Creating projects"
    }
  });

  const thirdListId = shortid.generate();

  store.dispatch({
    type: "ADD_LIST",
    payload: { listId: thirdListId, listTitle: "Done" }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: thirdListId,
      cardId: shortid.generate(),
      cardText: "Finish collage projects"
    }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: thirdListId,
      cardId: shortid.generate(),
      cardText: "Finish job"
    }
  });

  store.dispatch({
    type: "ADD_CARD",
    payload: {
      listId: thirdListId,
      cardId: shortid.generate(),
      cardText: "Finish job 2"
    }
  });
};
