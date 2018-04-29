from textblob import Word, TextBlob 
from textblob.np_extractors import ConllExtractor 	
from nltk.corpus import brown
import random
import sys


#w=Word("table")
#print (w.pluralize())
#print (w.lemmatize())
def main():
    
    #text="Hey it's me. Sorry I missed your call earlier. But I have a computer question that I wanted to ask you. Please call me back. "
    #print(sys.argv[1])
    with open(sys.argv[1], 'r') as myfile:
        text = myfile.read().replace('\n','')
    #print(data)

    #tags_=[]
    blob=TextBlob(text)
    #print(blob)
    pl=phone_let(blob)
    print (pl)
    
    words(text)
    
def phone_let(blob):
    
    phone_=list()
        
    for word, tag in blob.tags:
        if tag == 'CD':
            phone_.append(word)
    #return(phone_)

    list_digit_words=['zero','one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']
    list_digit_=[]
    for word in blob.words:
        if word in list_digit_words:
            list_digit_.append(word)
    #return(list_digit_) 

    list_w_numbers=[]                                          
    for item in list_digit_:
        if (item=='zero'):       
            list_w_numbers.append('0')
        if (item=='one'):
            list_w_numbers.append('1')    
        if (item=='two'):
            list_w_numbers.append('2')    
        if (item=='three'):       
            list_w_numbers.append('3')
        if (item=='four'):
            list_w_numbers.append('4')    
        if (item=='five'):
            list_w_numbers.append('5')  
        if (item=='six'):
            list_w_numbers.append('6')
        if (item=='seven'):
            list_w_numbers.append('7') 
        if (item=='eight'):
            list_w_numbers.append('8')
        if (item=='nine'):
            list_w_numbers.append('9')
#for i in list_w_numbers:
    #if (len(i)>5):
    return('Phone number: '+''.join(list_w_numbers))
    
def words(text):
    list_digit_words=['zero','one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine']
    extractor = ConllExtractor()
    blob = TextBlob(text, np_extractor=extractor)    
    noun_phrases=blob.noun_phrases 
    #print(noun_phrases)
    print('The voicemail is from ', end='')
    for np in noun_phrases:
        npp=np.split(' ')
        if len(npp)<=2:
                
                if np!='phone number' and np!='good day' and np!='great day':
                    if np not in list_digit_words:
                
                #if len(np)<=3:
                        print(np.title()+' ', end='')
                        
    
    verbs=list()
    for word, tag in blob.tags:
        if tag == 'VB':
            verbs.append(word.lemmatize())
    #print(verbs)        
    
    
    
    verbs_l=list()
    
    for i in verbs:
        i_l=i.lower()
        verbs_l.append(i_l)
    nouns=list()
    #print(verbs_l)
    if 'please' in verbs_l:
        next_word = verbs_l[verbs_l.index('please') + 1]
        print("Please" + ' ' + next_word + '\n', end='')
        if next_word=='call':
            print(' regarding ',end='')
            
            for word,tag in blob.tags:
                if tag == 'NN':
                     nouns.append(word.lemmatize())
#print(nouns)
            num=len(nouns)
            for item in random.sample(nouns, num):
               word=Word(item)
               if (word!='phone' and word!='number' and word!='name' ):
                            #if (word!='number'):
                   print (word, end=' ')
    else:
          print('Please \n ',end='')
          for verb in verbs_l:
              print(verb, end=' ')
          for word,tag in blob.tags:
                if tag == 'NN':
                     nouns.append(word.lemmatize())
#print(nouns)
          
          #print("\nThe voicemail is about ", end='')
          num=len(nouns)
          for item in random.sample(nouns, num):
               word=Word(item)
               if (word!='phone' and word!='number' and word!='name' ):
                   if word not in list_digit_words:
                            #if (word!='number'):
                       print (word, end=' ') 
          
        
    #print ("\nThe voicmail is about: ", end='')
    
 
 
   
main()



