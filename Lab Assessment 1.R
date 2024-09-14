mydata <- read.csv("D:/Summer23-24/Data Science[A]/Data Science Project/FL1/Dengudataset.csv", header = TRUE, sep =",")
mydata
help("hist")
?hist
hist(Age)
hist(Age, freq=F)
hist(Age,prob=T)
hist(Age, prob=T, ylim=c(0,65))
hist(Age, prob=T, ylim=c(0,65),breaks=7)
hist(Age, prob=T, ylim=c(0,65),breaks=14)
mydata
boxplot(mydata$Age, main="Boxplot for Age", ylab="Area", col="lightblue")
install.packages("e1071")
mydata <- read.csv("D:/Summer23-24/Data Science[A]/Data Science Project/FL1/Dengudataset.csv", header = TRUE, sep = ",")
barplot(table(mydata$Age), main="Bar Plot for Age", xlab="igG", ylab="igM", col="lightblue")
install.packages("e1071")
skewness_value <- skewness(mydata$igA, na.rm = TRUE)
print(paste("Skewness of the column:", skewness_value))
mydata <- read.csv("D:/Summer23-24/Data Science[A]/Data Science Project/FL1/Dengudataset.csv", header = TRUE, sep = ",")
install.packages("ggplot2")
library(ggplot2)
ggplot(mydata, aes(x = factor(HouseType), y = Age)) +
  geom_violin() +
  theme_minimal() +
  labs(title = "Violin Plot of Numeric Variable by Area", 
       x = "HouseType", 
       y = "Age")


ggplot(data = DataFrame)+geom_point(aes(x=age,y=igA,colour=as))
grapical representation()
mydata
plot(mydata$Age,mydata$igG)
