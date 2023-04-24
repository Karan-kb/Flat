
import pickle
import numpy as np
import pandas as pd
import os
import sys

df = pd.read_csv("Flat.csv")

def recommend_flats(df, query, search_by='rent'):
    # create a numpy array containing the location and rent values
    if search_by == 'rent':
        # search by rent
        query_col = 'Rent'
        query = str(query)
        flat_data = df[query_col].values
    elif search_by == 'location':
        # search by location
        query_col = 'Location'
        query = query.lower()
        flat_data = df[query_col].str.lower().values
    else:
        raise ValueError("search_by must be 'rent' or 'location'")

    flat_data = flat_data.astype(str)

    # calculate the term frequency and inverse document frequency (TF-IDF) values
    flat_words = [doc.split() for doc in flat_data]
    flat_vocab = sorted(set([word for doc in flat_words for word in doc]))
    flat_word_counts = [{word: doc.count(word) for word in flat_vocab} for doc in flat_words]
    flat_doc_counts = {word: sum([1 for doc in flat_words if word in doc]) for word in flat_vocab}
    flat_tfidf = np.array([[flat_word_counts[i][word] * np.log(len(flat_words) / flat_doc_counts[word])
                            for word in flat_vocab] for i in range(len(flat_data))])

    # calculate the cosine similarity between the query and all flats
    if search_by == 'rent':
        query_tfidf = np.array([[1.0 if word == query else 0.0 for word in flat_vocab]])
    else:
        query_tfidf = np.array([[1.0 if word in query.split() else 0.0 for word in flat_vocab]])
   
    sim_scores = np.dot(flat_tfidf, np.transpose(query_tfidf))
    sim_scores = sim_scores.flatten()

    # sort the flats based on their similarity score
    sim_scores = sorted(enumerate(sim_scores), key=lambda x: x[1], reverse=True)

    # get the top 10 most similar flats
    sim_scores = sim_scores[1:11]

    # get the flat indices and their similarity scores
    flat_indices = [i[0] for i in sim_scores]
    flat_scores = [i[1] for i in sim_scores]

    # create a dataframe of the top 10 similar flats
    flat_df = df.iloc[flat_indices][['Location', 'Rent', 'Category']]
    flat_df['similarity'] = flat_scores

    # return the dataframe
    return flat_df


# Load the saved model from a pickle file
model_file_path = 'recommend_flats_model.pkl'
with open(model_file_path, 'rb') as f:
    model = pickle.load(f)



# Take input from the user
query = '22000'
search_by = 'rent'

# Preprocess the user input
result = recommend_flats(df, query, search_by=search_by)

# Output the result
print(result)
